<?php

namespace App\Http\Livewire\Front\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Favorite;
use App\Models\ProductColor;
use App\Services\CartService;
use App\Models\ProductVariant;

class SingleProduct extends Component
{
    public $product, $favourite;
    public $qty = 1;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public $variant_id, $sell_price, $discount, $colors = [], $color_id;

    public function mount()
    {
        if (auth()->check()) {
            $this->favourite = Favorite::where('product_id', $this->product->id)->where('user_id', auth()->user()->id)->first();
        } else {
            $this->favourite = Favorite::where('product_id', $this->product->id)->where('session_id', session()->getId())->first();
        }
        if (!$this->product->variants()->exists()) {
            $this->colors = ProductColor::where('product_id', $this->product->id)->get();
        }
    }

    public function updatedVariantId()
    {
        $this->sell_price = ProductVariant::find($this->variant_id)?->sell_price;
        $this->discount = ProductVariant::find($this->variant_id)?->discount_price;
        $this->colors = ProductColor::where('variant_id', $this->variant_id)->get();
    }

    public function render()
    {
        return view('livewire.front.products.single-product');
    }


    public function addToFavorite()
    {
        if (!$this->favourite) {
            Favorite::create([
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'product_id' => $this->product->id,
                'session_id' => session()->getId(),
            ]);

            $this->dispatch('alert', type: 'success', message: 'تمت الاضافة لقائمة الأمنيات بنجاح');
        } else {
            Favorite::where('product_id', $this->product->id)->where(function ($q) {
                $q->where('user_id', auth()->user()?->id)->where('session_id', session()->getId());
            })->delete();

            $this->dispatch('alert', type: 'error', message: 'تمت الإزالة من قائمة الأمنيات بنجاح');
        }
        $this->mount();
    }

    public function increment()
    {
        $this->qty++;
    }

    public function decrement()
    {
        if ($this->qty != 1) {
            $this->qty--;
        }
    }

    public function add($id, $is_pre_order = false)
    {
        $product = Product::find($id);
        $variant = ProductVariant::find($this->variant_id);
        // check if product has sizes and check if size has colors
        $this->validate([
            'variant_id' => $product->variants()->exists() ? 'required' : 'nullable',
            'color_id' => $variant && $variant->colors()->exists() ? 'required' : 'nullable'
        ]);
        CartService::addToCart($id, $this->variant_id ?? null, $this->qty, $this->color_id, $is_pre_order);
        $this->dispatch('productAdded');
        $this->dispatch('alert', type: 'success', message: 'تم الاضافة لسلة التسوق');
    }

    public function purchase($id)
    {
        $avilableItem = CartService::getCart()->items;
        if ($avilableItem) {
            foreach ($avilableItem as $item) {
                $isFavorited = Favorite::where('user_id', auth()->id())
                    ->where('product_id', $item->product_id)
                    ->exists();
                if (!$isFavorited) {
                    $favorite = new Favorite();
                    $favorite->user_id = auth()->id();
                    $favorite->product_id = $item->product_id;
                    $favorite->save();
                }
            }
            CartService::getCart()->items()->delete();
        }


        CartService::addToCart($id, $this->variant_id, $this->qty);

        return redirect()->route('cart');
    }
}
