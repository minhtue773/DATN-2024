<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'order_number', 'description', 'image', 'is_hidden'];
    
    public function Product() {
        return $this->hasMany(Product::class);
    }
}
