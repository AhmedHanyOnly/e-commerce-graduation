<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsagePolicyController extends Controller
{
    public function index()
    {
        return view('admin.usage_policy');
    }

    public function update(Request $request)
    {
        $data = $request->validate(['usage_policy'=>'required']);
        setting($data)->save();
        return back()->with('success','تم الحفظ بنجاح');
    }

}
