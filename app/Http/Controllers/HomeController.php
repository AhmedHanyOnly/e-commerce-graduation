<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Admin\Products;
use App\Models\Banner;
use App\Models\Design;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Slider;
use App\Models\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // public function index()
    // {
    //     $sliders = Slider::get();
    //     $banner = Banner::first();
    //     $designs = Design::get();
    //     $latest_products = Product::take(10)->latest()->get();

    //     // $most_sold_products = Product::select('products.id', 'products.name', 'products.sell_price', DB::raw('SUM(items.qty) as total_sold'))
    //     //     ->join('items', 'products.id', '=', 'items.product_id')
    //     //     ->join('orders', 'items.model_id', '=', 'orders.id')
    //     //     ->groupBy('products.id', 'products.name', 'products.sell_price')
    //     //     ->orderByDesc('total_sold')
    //     //     ->take(10)
    //     //     ->get();
    //     $most_sold_products = Product::select('products.id', 'products.name', 'products.quantity', DB::raw('MAX(products.image) AS image'), 'products.sell_price', DB::raw('SUM(items.qty) as total_sold'))
    //         ->join('items', 'products.id', '=', 'items.product_id')
    //         ->join('orders', 'items.model_id', '=', 'orders.id')
    //         ->groupBy('products.id', 'products.name', 'products.sell_price', 'products.quantity')
    //         ->orderByDesc('total_sold')
    //         ->take(10)
    //         ->get();

    //     $offer_products = Product::Where('special_offer', 1)->take(10)->latest()->get();
    //     $other_products = Product::inRandomOrder()->take(10)->get();

    //     return view('front.index', compact('sliders', 'other_products', 'banner', 'designs', 'latest_products', 'most_sold_products', 'offer_products'));
    // }
    // في المؤشر 'ProductController@index'

    public function index()
    {
        $sliders = $this->getProductData('sliders',\App\Models\Slider::latest());
        $designs = $this->getProductData('designs',Design::latest());
        $banner = Banner::where('status', 1)->first();
        $query =Product::query()->with('variants');

        $latest_products = $this->getProductData(
            'latest-products',$query->where('active', 1)
            ->take(10)
                ->latest()
        );

        $offer_products = $this->getProductData(
            'offer_products',$query->where('active', 1)
            ->where('special_offer', 1)
            ->take(10)
            ->latest()
        );

        $other_products = $this->getProductData(
            'other_products',$query->where('active', 1)->inRandomOrder()->take(10)
        );
        $most_sold_products = Product::with('variants')->select('products.id', 'products.name', 'products.quantity', DB::raw('MAX(products.image) AS image'), 'products.sell_price', DB::raw('SUM(items.qty) as total_sold'))
            ->join('items', 'products.id', '=', 'items.product_id')
            ->join('orders', 'items.model_id', '=', 'orders.id')
            ->where('products.active', 1)
            ->groupBy('products.id', 'products.name', 'products.sell_price', 'products.quantity')
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();


        return view('front.index', compact('sliders', 'other_products', 'banner', 'designs', 'latest_products', 'most_sold_products', 'offer_products'));
    }

    private function getProductData($cacheKey, $query)
    {
        if (cache($cacheKey)){
            return cache($cacheKey);
        }
        return Cache::rememberForever($cacheKey, function () use ($query) {
            return $query->get();
        });

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
}
