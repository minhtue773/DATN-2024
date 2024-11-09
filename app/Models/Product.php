<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'discount',
        'stock',
        'view',
        'status',
        'is_hidden'
    ];

    // Tự động tạo slug khi tạo mới sản phẩm
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $slug = Str::slug($product->name);

                // Kiểm tra sự trùng lặp của slug và thêm hậu tố cho slug nếu cần
                $slugBase = $slug;
                $count = 0;
                while (Product::where('slug', $slug)->exists()) {
                    $count++;
                    $slug = $slugBase . '-' . $count; // Thêm hậu tố
                }

                $product->slug = $slug;
            }
        });
    }
    public function relatedProducts($limit = 4)
    {
        return self::where('product_category_id', $this->product_category_id)
            ->where('id', '<>', $this->id) // Loại trừ sản phẩm hiện tại
            ->visible() // Gọi scope để chỉ lấy sản phẩm không bị ẩn
            ->inStock() // Chỉ lấy sản phẩm còn hàng
            ->take($limit) // Giới hạn số lượng sản phẩm liên quan
            ->get();
    }


    // Quan hệ belongsTo đến bảng ProductCategory
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->productCategory ? $this->productCategory->name : 'N/A';
    }
    // Quan hệ hasMany với ProductImage
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Quan hệ belongsToMany với User thông qua bảng favorite_products
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorite_products', 'product_id', 'user_id');
    }

    // Accessor cho thuộc tính 'price' (định dạng lại khi truy xuất)
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', '.') . ' VND';
    }

    // Scope để lọc sản phẩm đang còn hàng
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Scope để lọc sản phẩm có giảm giá
    public function scopeDiscounted($query)
    {
        return $query->where('discount', '>', 0);
    }

    // Scope để lọc sản phẩm không bị ẩn
    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }
}
