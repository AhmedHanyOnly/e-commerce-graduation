<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuccessPaymentController extends Controller
{
    
    public function update(Request $request)
    {
        
        $data = $request->validate(['success_payment'=>'required']);
        setting($data)->save();
        return back()->with('success','تم الحفظ بنجاح');
    }

}
