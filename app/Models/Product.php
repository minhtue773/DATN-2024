<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes; // Sử dụng các trait HasFactory và SoftDeletes

    protected $fillable = [
        'product_category_id', 'name', 'description', 'image', 'price',
        'discount', 'stock', 'view', 'status', 'is_hidden'
    ]; // Các trường có thể gán giá trị hàng loạt

    // Quan hệ belongsTo đến bảng ProductCategory
    public function productCategory() {
        return $this->belongsTo(ProductCategory::class); // Quan hệ đến danh mục sản phẩm
    }

    // Quan hệ hasMany với ProductImage
    public function productImages() {
        return $this->hasMany(ProductImage::class); // Quan hệ đến hình ảnh sản phẩm
    }

    // Quan hệ belongsToMany với User thông qua bảng favorite_products
    public function favoritedBy() {
        return $this->belongsToMany(User::class, 'favorite_products', 'product_id', 'user_id'); // Quan hệ đến người dùng yêu thích sản phẩm
    }
}
