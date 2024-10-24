<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Các trường có thể gán hàng loạt.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'phone_number',
        'name',
        'address',
        'role',
        'gender',
        'status',
        'birthday',
    ];

    /**
     * Các trường sẽ được ẩn trong array hoặc JSON.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kiểu dữ liệu cần được chuyển đổi.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
    ];

    /**
     * Mặc định sử dụng timestamps (true).
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Quan hệ belongsToMany với bảng Product thông qua bảng trung gian favorite_products.
     *
     * @return BelongsToMany
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'favorite_products', 'user_id', 'product_id')->withTimestamps();
    }
}