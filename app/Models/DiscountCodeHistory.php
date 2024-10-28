<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCodeHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_code_id',
        'user_id',
        'applied_date',
    ];

    public function discountCode()
    {
        return $this->belongsTo(DiscountCode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}