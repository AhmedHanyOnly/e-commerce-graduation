<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class CartService
{
    public static function getCart()
    {
        return Cart::with('items')
            ->withCount('items')
            ->where(function ($query) {
                if (auth()->check()) {
                    $query->where('user_id', auth()->id());
                } else {
                    $query->where('session_id', \request()->session()->getId());
                }
            })
            ->firstOrCreate([
                'user_id' => auth()->check() ? auth()->id() : null,
                'ip' => request()->ip(),
                'session_id' => auth()->check() ? null : \request()->session()->getId(),
            ]);
    }

    public static function getTotal()
    {
        if (self::getCart()->items_count) {
            $subtotal = self::getCart()->items->sum('total');
            return $subtotal + setting('shipping_price');
        }
        return 0;
    }

    public static function addToCart($id, $variant_id = null, $qty = 1, $color_id = null, $is_pre_order = false)
    {
        $product = Product::with('variants')->find($id);
        if (!$variant_id && $product->has('variants')) {
            $variant_id = $product->variants()->first()?->id;
        }
        $item = self::getCart()
            ->items()
            ->where(['product_id' => $product->id, 'variant_id' => $variant_id])
            ->first();

        if ($item) {
            $item->update([
                'qty' => $item->qty + $qty,
                'variant_id' => $variant_id,
                'color_id' => $color_id,
                'is_pre_order' => $is_pre_order
            ]);
        } else {
            $item = self::getCart()
                ->items()->create([
                        'product_id' => $product->id,
                        'qty' => $qty,
                        'variant_id' => $variant_id,
                        'color_id' => $color_id,
                        'is_pre_order' => $is_pre_order
                    ]);
        }
        self::updateCalculateForItem($item);
    }

    public static function checkProductAvailable($id, $qty)
    {
        $product = Product::find($id);
        if (!$product->no_quantity && !$product->digital_product) {
            return $product->quantity >= $qty;
        }
        return true;
    }

    public static function decrement($id)
    {
        $item = self::getCart()
            ->items()
            ->where(['id' => $id])
            ->first();
        if ($item->qty > 1) {
            $item->decrement('qty', 1);
            $item->save();
            self::updateCalculateForItem($item);
        } else {
            $item->delete();
        }
    }

    public static function increment($id)
    {
        $item = self::getCart()
            ->items()
            ->where(['id' => $id])
            ->first();
        $item->increment('qty', 1);
        $item->save();
        self::updateCalculateForItem($item);
    }

    public static function updateCalculateForItem($item)
    {
        $product = Product::find($item->product_id);
        $main = $item->variant_id ? ProductVariant::find($item->variant_id) : $product;
        $qty = $item->qty;
        $product_total = $main->discounted_price ?: $main->sell_price;
        $tax = setting('is_tax') ? setting('tax', 15) / 100 * ($product_total * $qty) : 0;

        $item->tax = $tax;
        $item->update([
            'tax' => $tax,
            'total' => $product_total * $qty + $tax,
            'purchase_price' => $main->purchase_price,
            'sell_price' => $product_total,
        ]);
    }

    public static function addSessionCartToAuthUser($user)
    {
        $authUserCart = Cart::whereUserId($user->id)->first();
        $Guest_cart = Cart::where('session_id', \request()->session()->getId())->where('ip', \request()->ip())->first();
        if ($Guest_cart && $authUserCart) {
            if (!$Guest_cart->items->count()) {
                $Guest_cart->delete();
            } else {
                $authUserCart->delete();
                $Guest_cart->update(['user_id' => $user->id]);
            }
        }
    }

    public static function removeFromCart($id)
    {
        self::getCart()->items()->where(['id' => $id])->delete();
    }

    public static function transferSessionCartToUser(User $user, string $sessionId)
    {
        DB::transaction(function () use ($user, $sessionId) {
            // Get authenticated user's cart
            $userCart = Cart::with('items')->where('user_id', $user->id)->first();

            // Get guest cart with items
            $guestCart = Cart::with('items')
                ->where('session_id', $sessionId)
                ->where('ip', request()->ip())
                ->first();

            // Case 1: Guest has cart with items
            if ($guestCart && $guestCart->items->isNotEmpty()) {
                // If user has existing cart, merge items
                if ($userCart) {
                    foreach ($guestCart->items as $item) {
                        // Check if item exists in user's cart
                        $existingItem = $userCart->items()
                            ->where('product_id', $item->product_id)
                            ->first();

                        if ($existingItem) {
                            // Update quantity if item exists
                            $existingItem->update([
                                'qty' => $existingItem->qty + $item->qty
                            ]);
                            $item->delete();
                        } else {
                            // Move item to user's cart
                            $item->update(['model_id' => $userCart->id, 'model_type' => Cart::class]);
                        }
                    }
                    $guestCart->delete();
                } else {
                    // No user cart exists, just transfer ownership
                    $guestCart->update([
                        'user_id' => $user->id,
                        'session_id' => null
                    ]);
                }
            }
            // Case 2: Guest has empty cart
            elseif ($guestCart) {
                $guestCart->delete();
            }

        });
    }
}
