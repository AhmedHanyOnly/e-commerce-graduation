<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavouriteController extends Controller
{
    public function __invoke($productId)
    {
        $user = auth()->user();
        if (!$user) {
            return response([
                'status' => 'false',
                'msg' => 'غير مسجل'
            ]);
        }
        $product = Product::findOrFail($productId);
        $fav = Favorite::where(['user_id' => $user->id, 'product_id' => $product->id])->first();
        if ($fav) {
            $fav->delete();
            return response([
                'status' => true,
                'msg' => 'تمت الإزالة من قائمة الأمنيات بنجاح'
            ]);
        }
        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
        return response([
            'status' => true,
            'msg' => 'تمت الاضافة لقائمة الأمنيات بنجاح'
        ]);
    }
}
