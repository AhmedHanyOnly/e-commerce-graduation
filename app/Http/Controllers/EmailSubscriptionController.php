<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailSubscription;

class EmailSubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:email_subscriptions,email',
        ], [
            'email.unique' => "الايميل موجود من قبل"
        ]);

        EmailSubscription::create([
            'email' => $request->email,
        ]);

        return back()->with('success',"تم الاشتراك في القائمة البريدية");
    }
}
