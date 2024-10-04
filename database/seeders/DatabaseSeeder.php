<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Product::create([
            'name' => 'Sản phẩm 1',
            'description' => 'Mô tả sản phẩm 1',
            'price' => 100000,
            'quantity' => 10,
        ]);
    
        \App\Models\Product::create([
            'name' => 'Sản phẩm 2',
            'description' => 'Mô tả sản phẩm 2',
            'price' => 200000,
            'quantity' => 20,
        ]);
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
    
        \App\Models\User::create([
            'name' => 'Khách hàng',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
        ]);
    
    }
}
