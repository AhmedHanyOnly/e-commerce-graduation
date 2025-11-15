<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Traits\JodaResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    // use JodaResource;


    // public $rules = [
    //     'title' => 'required',
    //     'desc' => 'required',
    // ];

    // public function query($query)
    // {
    //     return $query->latest()->paginate(10);
    // }
    public function index()
    {
        $about = About::first();

        return view('admin.about_us.create', compact('about'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image',
            // يمكنك إضافة قواعد التحقق الأخرى هنا
        ]);

        if (isset($request->id)) {
            $about = About::find($request->id);
        } else {
            $about = new About();
        }

        if ($image = $request->file('image')) {
            $about['image'] = store_file($image, 'about');
        }

        $about->title = $request->title;
        // $about->title_en = $request->title_en;

        $about->desc = $request->desc;

        $about->save();

        return back()->with('message', trans('تم تعديل من نحن بنجاح'));
    }
}
