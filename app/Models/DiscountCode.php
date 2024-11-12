<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'discount',
        'max_discount',
        'quantity',
        'used_count',
        'start_date',
        'expiry_date',
        'status',
        'is_hidden',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'discount' => 'decimal:2',
        'max_discount' => 'decimal:2',
    ];
}