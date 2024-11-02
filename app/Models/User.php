<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'phone_number',
        'name',      
        'image',    
        'address',
        'role',
        'gender',
        'status',
        'birthday',
        'facebook_id',
        'google_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function favoriteProducts () {
        return $this->hasMany(FavoriteProduct::class);
    }
    public function posts () {
        return $this->hasMany(Post::class);
    }
    public function comments () {
        return $this->hasMany(Comment::class);
    }
    public function orders () {
        return $this->hasMany(Order::class);
    }
    public function discountCodeHistories () {
        return $this->hasMany(DiscountCodeHistory::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorite_products', 'user_id', 'product_id')->withTimestamps();
    }
    public function favoritedBy() {
        return $this->belongsToMany(Product::class, 'favorite_products', 'user_id', 'product_id');
    }
}
