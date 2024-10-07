<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','name','description','image','price','discount','stock','view','status','is_hidden'];
    
    public function ProductCategory() {
        return $this->belongsTo(ProductCategory::class);
    }
}
