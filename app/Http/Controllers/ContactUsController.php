<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        ContactUs::create($validated);
        return redirect()->back()->with('success', trans('تم الارسال بنجاح'));
    }
}
