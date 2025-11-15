<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\Builder;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    // public function created(Order $order): void
    // {
    //     Notification::send(User::first()->id, "تم اضافة طلب جديد", route('admin.orders'));
    // }
    public function created(Order $order): void
    {
        $clientName = $order->client->name;
        $orderNumber = $order->number;
        Notification::send(User::first()->id, "تم إضافة طلب جديد من العميل $clientName برقم الطلب $orderNumber", route('admin.orders'));
    }


    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->isDirty('status')) {
            if ($order->status == 'accepted') {
                $msg = " تم قبول الطلب رقم $order->number الخاص بك ";
                Notification::send($order->client_id, $msg, route('profile'));
            } elseif ($order->status == 'in_progress') {
                Notification::send($order->client_id, " جاري توصيل الطلب رقم $order->number", route('client.profile'));
            } elseif ($order->status == 'done') {
                Notification::send($order->client_id, " تم توصيل الطلب رقم $order->number", route('profile'));
            } else {
                Notification::send($order->client_id, " تم رفض الطلب رقم $order->number", route('notice'));
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
