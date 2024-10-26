<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'status',
        'order_number',
        'image',
        'status',
    ];
    public function posts () {
        return $this->HasMany(Post::class, 'category_id');
    }
    // Trong model PostCategory
    public function postsCountWithTrashed()
    {
        return $this->posts()->withTrashed()->count();
    }

}