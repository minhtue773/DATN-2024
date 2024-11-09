<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'content',
        'status',
        'image',
        'is_featured',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $slug = Str::slug($post->title);

                // Kiểm tra sự trùng lặp của slug và thêm hậu tố nếu cần
                $slugBase = $slug;
                $count = 0;
                while (Post::where('slug', $slug)->exists()) {
                    $count++;
                    $slug = $slugBase . '-' . $count;
                }

                $post->slug = $slug;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }
}