<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = ['product_category_id','name','description','image','price','discount','stock','view','status','is_hidden'];
    
    public function productCategory() {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productImage() {
        return $this->hasMany(ProductImage::class);
    }
}
