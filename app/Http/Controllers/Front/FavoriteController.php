<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', auth()->user()?->id)->orWhere('session_id', session()->getId())->get();
        return view('front.favorite', compact('favorites'));
    }

    public function destroy($id)
    {
        $favourite = Favorite::findOrFail($id);
        $favourite->delete();
        return back()->with('success', 'تمت الإزالة من قائمة الأمنيات بنجاح');
    }
}
