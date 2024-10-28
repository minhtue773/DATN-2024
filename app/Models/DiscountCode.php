<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'quantity',
        'applied_amount_for_discount_code',
        'status',
        'discount_percentage',
        'maximum_discount_amount',
    ];
}