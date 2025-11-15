<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
   public function index()
{
    $notifications = Notification::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->paginate(10); // عدد الإشعارات لكل صفحة

    $notificationGroups = $notifications->getCollection()
        ->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d l');
        });

    $notifications->setCollection(collect($notificationGroups)); // نعيد التجميع كمجموعة في الباجينيتر

    // تعليم الكل كمقروء
    $unreadNotifications = auth()->user()->unreadNotifications()->get();
    foreach ($unreadNotifications as $noti) {
        $noti->markAsSeen();
    }

    return view('front.notice', [
        'notificationGroups' => $notificationGroups,
        'notifications' => $notifications // نحتاجه للروابط
    ]);
}

public function destroy($id)
{
    $notification = Notification::where('user_id', auth()->id())->findOrFail($id);
    $notification->delete();

    return redirect()->back()->with('success', 'تم حذف الإشعار بنجاح.');
}

public function destroyAll()
{
    Notification::where('user_id', auth()->id())->delete();

    return redirect()->back()->with('success', 'تم حذف جميع الإشعارات بنجاح.');
}


}
