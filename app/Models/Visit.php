<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'page',
        'visited_at'
    ];

    public $timestamps = false;
}
