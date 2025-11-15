<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Cookie;
use App\Models\Favorite;

// استدعاء النموذج Favorite

class ProductController extends Controller
{
    public function show(Product $product)
    {
        abort_if(!$product->active, 404);

        $related_products = Product::with('rates.user')->where('id', '!=', $product->id)->where(function ($q) use ($product) {
            $q->where('category_id', $product->category_id);
        })->take(10)->get();

        if (!$this->hasViewedProduct($product->id)) {
            $this->recordProductView($product->id);
        }
        return view('front.products.show', compact('product', 'related_products'));
    }

    public function addComment(Request $request, Product $product)
    {
        $data = $request->validate([
            'comment' => 'required|min:5',
        ]);
        $product->comments()->create([
            'content' => $data['comment'],
            'user_id' => auth()->id(),
            'comment_id' => $data['comment_id'] ?? null,
            'status' => setting('accept_comment_automatically') ? 'accepted' : 'pending'
        ]);

        return redirect()->back()->with('success1', 'تم إضافة التعليق بنجاح');
    }

    public function addReply(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'reply' => 'required|min:5',
        ]);
        $comment->replies()->create([
            'content' => $data['reply'],
            'user_id' => auth()->id(),
            'product_id' => $comment->product_id,
            'status' => setting('accept_comment_automatically') ? 'accepted' : 'pending'
        ]);

        return redirect()->back()->with('success1', 'تم إضافة الرد بنجاح');
    }

    private function hasViewedProduct($productId)
    {
        return Cookie::has('product_' . $productId . '_viewed');
    }

    private function recordProductView($productId)
    {
        Product::where('id', $productId)->increment('views');
        Cookie::queue('product_' . $productId . '_viewed', true, 14400);
    }

    public function addToFavorites($productId)
    {
        try {
            $product = Product::findOrFail($productId);

            $isFavorited = Favorite::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->exists();
            if ($isFavorited) {
                return redirect()->back()->with('error', 'المنتج مفضل بالفعل');
            }

            $favorite = new Favorite();
            $favorite->user_id = auth()->id();
            $favorite->product_id = $productId;
            $favorite->save();

            return redirect()->back()->with('success', 'تمت الإضافة إلى المفضلة بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء محاولة إضافة المنتج إلى المفضلة');
        }
    }

    public function storeRate(Request $request, Product $product)
    {
        $data = $request->validate([
            'rate' => 'required|integer|between:1,5',
            'comment' => 'nullable',
        ]);
        $data['user_id'] =auth()->id();
        $product->rates()->create($data);
        return back()->with('success', 'تم التقييم بنجاح شكرا لك !');
    }
}
