<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        return view('admin.privacy_policy');
    }

    public function update(Request $request)
    {
       $data = $request->validate(['privacy_policy'=>'required']);
       setting($data)->save();
        return back()->with('success','تم الحفظ بنجاح');

    }
}
