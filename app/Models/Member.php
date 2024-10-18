<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Các thuộc tính có thể được gán giá trị hàng loạt
    protected $fillable = [
        'name',
        'images',
        'describe',
        'link_facebook',
        'link_zalo',
        'position',
    ];
}