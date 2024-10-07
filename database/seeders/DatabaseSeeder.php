<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        ProductCategory::factory()
        ->count(4)
        ->state(new Sequence(
            ['name' => 'Mô hình One Piece'],
            ['name' => 'Mô hình Dragon Ball'],
            ['name' => 'Mô hình Gundam'],
            ['name' => 'Mô hình Naruto']
        ))
        ->has(Product::factory()->count(5))
        ->create();
    }
}
