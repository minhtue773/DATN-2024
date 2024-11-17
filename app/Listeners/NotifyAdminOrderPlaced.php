<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderPlaced;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderPlacedNotification;


class NotifyAdminOrderPlaced
{
    public function __construct()
    {
        //
    }

    
    public function handle(OrderPlaced $event): void
    {
        $order = $event->order;
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new OrderPlacedNotification($order));
    }
}
