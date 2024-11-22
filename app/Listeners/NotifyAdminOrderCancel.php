<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderCancel;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCancelNotification;


class NotifyAdminOrderCancel
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCancel $event): void
    {
        $order = $event->order;
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new OrderCancelNotification($order));
    }
}
