<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteProduct extends Model
{
    // Khai báo các cột có thể được gán hàng loạt
    protected $fillable = ['product_id', 'user_id'];

    /**
     * Liên kết với model Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Liên kết với model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
