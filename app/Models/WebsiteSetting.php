<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu khác với quy tắc đặt tên mặc định
    protected $table = 'website_settings';

    // Các thuộc tính có thể gán hàng loạt
    protected $fillable = [
        'setting_key',
        'setting_value',
        'description',
    ];

    // Nếu bạn có trường timestamps (created_at, updated_at)
    public $timestamps = true;
}