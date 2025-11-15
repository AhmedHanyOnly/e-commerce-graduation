<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\PaymentTransaction;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Stripe\Webhook;

class StripeController extends Controller
{

    public function __construct(public StripeService $stripeService)
    {

    }

    public function pay(Order $order)
    {
        if ($order->status !== 'pending' || $order->payment_status || $order->client_id !== auth()->user()->id) {
            abort(403,'لا يمكنك دفع هذا الطلب');
        }

        try {
          $url =  app(StripeService::class)->generatePayLink($order);
          if (!$url){
              return back()->with('error', 'حدث خطا في عملية الدفع');
          }
          return redirect()->away($url);
        }catch (\Exception $exception){
            return back()->with('error', 'حدث خطا في عملية الدفع');
        }

    }

    public function handleRedirect()
    {
        $session_id = \request('session_id');
        if (!$session_id) {
            return to_route('payment.fail');
        }
        $sessionData = $this->stripeService->callback($session_id);
        if (!$sessionData || $sessionData->payment_status !== 'paid') {
            return to_route('payment.fail');
        }

        $paymentTransaction = PaymentTransaction::whereTransactionId($sessionData->id)->first();
        if ($paymentTransaction->order->payment_status === 'paid') {
            return to_route('payment.fail');
        }

        $paymentTransaction->status = PaymentStatus::Paid;
        $paymentTransaction->save();

        $paymentTransaction->order()->update([
            'payment_status' => 1,
            'payment_method' => 'stripe',
        ]);
        return to_route('payment.success');

    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $paymentTransaction = PaymentTransaction::whereTransactionId($session->transaction_id)->first();
                if (!$paymentTransaction || $paymentTransaction->status !== PaymentStatus::Paid) {
                    return response('Invalid payment', 400);
                }
                $paymentTransaction->status = PaymentStatus::Paid;
                $paymentTransaction->save();

                $paymentTransaction->order()->update([
                    'payment_status' => 1
                ]);

                break;
        }

        return response('Webhook handled', 200);


    }

}
