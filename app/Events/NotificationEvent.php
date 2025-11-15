<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $notification;
    public function __construct($user_id, $notification)
    {
        $this->user_id = $user_id;
        $this->notification = $notification;
    }
    public function broadcastAs()
    {
        return 'new-notification'; // event
    }

    public function broadcastOn()
    {
        return ['new-notification-' . $this->user_id]; // channel
    }
}
