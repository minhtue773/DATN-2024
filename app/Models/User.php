<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * Nếu không sử dụng timestamps, có thể tắt bằng cách:
     *
     * @var bool
     */
    public $timestamps = true;
}