<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ClickPay;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function clickpay(Request $request)
    {
        $payment = new ClickPay('clickpay.callback');
        $response = $payment->verify($request);
        if ($response['success']) {
            $order = Order::where('ref_id', $response['payment_id'])->first();
            if (!$order || $order->paid_at != null) {
                return to_route('cart')->with('error', 'حدث خطا في عملية الدفع الرجاء التواصل مع الدعم');
            }
            $order->update(['paid_at' => now(),'status' => 'completed']);
            return to_route('success_payment')->with('success', 'تم الدفع بنجاح !');
        }
        return to_route('cart')->with('error', 'حدث خطا في عملية الدفع الرجاء التواصل مع الدعم');
    }
}
