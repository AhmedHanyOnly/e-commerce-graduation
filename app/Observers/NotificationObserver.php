<?php

namespace App\Observers;

use App\Models\Notification;
use App\Events\NotificationEvent;

class NotificationObserver
{
    public function created(Notification $notification)
    {
        event(new NotificationEvent($notification->user_id, $notification));
    }
}
