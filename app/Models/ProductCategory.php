<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory; // Sử dụng trait HasFactory

    protected $fillable = ['name', 'order_number', 'description', 'image', 'status'];
    
    public function products() {
        return $this->hasMany(Product::class);
    }
}