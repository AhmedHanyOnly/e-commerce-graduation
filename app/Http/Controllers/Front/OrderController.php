<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Rate;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function storeRate(Request $request, Order $order)
    {
        $request->validate([
            'rate' => 'required|integer|between:1,5',
            'comment' => 'nullable',
        ]);

        $order->order_rate()->create([
            'user_id' => auth()->user()->id,
            'rate' => $request->rate,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'تم تقييم الطلب بنجاح');
    }
}
