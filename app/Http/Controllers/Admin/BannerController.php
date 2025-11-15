<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
    //    $banner = Banner::first();

       return view('admin.banners.index');
    }


    public function update(Request $request)
    {
        $request->validate([
            'image_one' => 'nullable|image',
            'image_two' => 'nullable|image',

            // يمكنك إضافة قواعد التحقق الأخرى هنا
        ]);

        if (isset($request->id)) {
            $banner = Banner::find($request->id);
        } else {
            $banner = new Banner();
        }

        if ($image = $request->file('image_one')) {
            $banner['image_one'] = store_file($image, 'banner');
        }
        if ($image = $request->file('image_two')) {
            $banner['image_two'] = store_file($image, 'banner');
        }


        $banner->save();

        return back()->with('message', trans('تم تحديث البانر بنجاح   '));
    }
}
