<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','total','payment_method','payment_status','recipient_phone','recipient_address','applied_discount_code','status','invoice_code','note','created_at','updated_at','deleted_at'];

    public function User() {
        return $this->belongsTo(User::class);
    }
}
