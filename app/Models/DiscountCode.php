<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'type', 'discount', 'max_discount', 'expiry_date', 'status', 'quantity', 'used_count'];

    // Kiểm tra mã còn hợp lệ không
    public function isValid()
    {
        return $this->status === 'active' 
            && $this->expiry_date >= now() 
            && $this->used_count < $this->quantity;
    }

    // Hàm tính giảm giá dựa trên loại voucher
    public function calculateDiscount($total)
    {
        if ($this->type === 'percentage') {
            // Giảm giá theo phần trăm
            return ($this->discount / 100) * $total;
        }

        if ($this->type === 'fixed') {
            // Giảm giá theo số tiền cố định
            return min($this->discount, $total);
        }

        if ($this->type === 'percentage_with_cap') {
            // Giảm giá theo phần trăm với mức giảm tối đa
            $discountAmount = ($this->discount / 100) * $total;
            return min($discountAmount, $this->max_discount);
        }

        return 0;
    }

    // Tăng số lần sử dụng khi mã được áp dụng
    public function incrementUsage()
    {
        $this->increment('used_count');
    }
}