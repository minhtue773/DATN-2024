<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('orders', function (?User $user) {
    return $user && $user->role === 'admin';
});