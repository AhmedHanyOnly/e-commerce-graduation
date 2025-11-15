<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        return view('admin.terms');
    }

    public function update(Request $request)
    {
        $data = $request->validate(['terms'=>'required']);
        setting($data)->save();
        return back()->with('success','تم الحفظ بنجاح');
    }

}
