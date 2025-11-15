<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $categoryIds = (array) request()->get('category_id');
            $categoryChildIds = (array) request()->get('category_child_id');
            $typeIds = (array) request()->get('type_id');
            $deliveryType = (string) request()->get('delivery_type');
            $minPrice = (int) request()->get('price_min');
            $maxPrice = (int) request()->get('price_max');
            $limit = ((int) request()->get('limit')) ?? 10;
            $products = Product::active()->where(function ($q) use ($categoryIds, $typeIds, $deliveryType, $minPrice, $maxPrice, $categoryChildIds) {
                if ($categoryIds) {
                    $q->whereIn('category_id', $categoryIds)->orWhereIn('category_child_id', $categoryIds);
                }
                if ($typeIds) {
                    $q->whereIn('product_type_id', $typeIds);
                }
                if ($deliveryType) {
                    $q->where('delivery_type', $deliveryType);
                }
                if ($minPrice) {
                    $q->where('sell_price', '>=', $minPrice);
                }
                if ($maxPrice) {
                    $q->where('sell_price', '<=', $maxPrice);
                }
            })->where('active', 1)->paginate($limit);
            $products->load(['files']);
            // $products_resource = ProductResource::collection($products);
            return ProductResource::collection($products);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }


    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|array',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'one of the required fields or both have not been provided'], 400);
        }
        $products = Product::with(['files'])->whereIn('category_id', $request->category)->get();

        return response(ProductResource::collection($products));
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product && $product->active == 1) {
            $product->load(['files']);
            $product_resource = ProductResource::make($product);
            return response($product_resource);
        } else {
            return response()->json([
                'message' => 'Product Not Found'
            ], 404);
        }
    }

    public function addToCart($id)
    {

        $is_pre_order = request()->get('pre_order') == 'true' ? 1 : 0;
        CartService::addToCart($id, null, 1, null, $is_pre_order);
        return response()->json([
            'message' => 'تم الاضافة للسلة بنجاح',
            'count' => CartService::getCart()->items_count,
            'total_balance' => CartService::getTotal()
        ]);
    }

    public function cart_count()
    {
        return response()->json([
            'cart_count' => CartService::getCart()->items_count
        ]);
    }

    public function productFilters()
    {
        // $productCategories = Category::latest()->select('id', 'name', 'cover')->withCount('products')->get();
        $productCategoriesChilds = Category::active()->whereNotNull('parent_id')->whereRelation('parent', 'status', 1)->latest()->select('id', 'name', 'cover', 'parent_id')->withCount('products')->get();
        $productTypes = ProductType::latest()->select('id', 'name', 'image')->withCount('products')->get();
        return response()->json([
            'categories' => $productCategoriesChilds,
            // 'category_childs' => $productCategoriesChilds,
            'types' => $productTypes,
            'delivery_type' => [
                [
                    'key' => 'same_day',
                ],
                [
                    'key' => '24_hours',
                ]

            ]
        ]);
    }

    public function markAsSeen()
    {
        auth()->user()->unreadNotifications()->update(['seen_at' => now()]);
        return response(['status' => true]);
    }
}
