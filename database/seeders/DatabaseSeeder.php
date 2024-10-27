<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo 10 người dùng giả lập
        User::factory(10)->create();

        // Tạo các danh mục sản phẩm với tên định sẵn
        ProductCategory::factory()
            ->count(4)
            ->state(new Sequence(
                ['name' => 'Mô hình One Piece'],
                ['name' => 'Mô hình Dragon Ball'],
                ['name' => 'Mô hình Gundam'],
                ['name' => 'Mô hình Naruto']
            ))
            ->has(Product::factory()->count(5)) // Tạo 5 sản phẩm cho mỗi danh mục
            ->create();
        DB::table('website_settings')->insert([
            [
                'setting_key' => 'site_name',
                'setting_value' => 'HobbyZone',
                'description' => 'Tên của trang web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'company_description',
                'setting_value' => 'ạhdjkahsdjyoqweiuna,msdalskdjadlks',
                'description' => 'Mô tả trang web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'company_name',
                'setting_value' => 'HobbyZone',
                'description' => 'Tên công ty',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'email',
                'setting_value' => 'hobbyzone@gmail.com',
                'description' => 'Email liên hệ',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'phone_number',
                'setting_value' => '0899384048',
                'description' => 'Số điện thoại liên hệ',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'address',
                'setting_value' => '123 streett',
                'description' => 'Địa chỉ doanh nghiệp',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'map',
                'setting_value' => 'url',
                'description' => 'Link nhúng bản đồ vị trí',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'facebook',
                'setting_value' => 'url',
                'description' => 'Link facebook',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'tiktok',
                'setting_value' => 'url',
                'description' => 'Link tiktok',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'youtube',
                'setting_value' => 'url',
                'description' => 'Link youtube',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'instagram',
                'setting_value' => 'url',
                'description' => 'Link instagram',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'twitter',
                'setting_value' => 'url',
                'description' => 'Link twitter',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'setting_key' => 'linkedin',
                'setting_value' => 'url',
                'description' => 'Link linkedin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        

        // $faker = Faker::create();
        // for ($i = 0; $i < 1000; $i++) {
        //     DB::table('products')->insert([
        //         'category_id' => rand(1, 4), // Danh mục ngẫu nhiên từ 1 đến 4 (vì chỉ có 4 danh mục được tạo)
        //         'name' => $faker->words(3, true), // Tên ngẫu nhiên với 3 từ
        //         'description' => $faker->sentence(10), // Mô tả ngẫu nhiên
        //         'image' => $faker->imageUrl(640, 480, 'products', true), // Hình ảnh ngẫu nhiên từ Faker
        //         'price' => $faker->randomFloat(2, 100000, 10000000), // Giá ngẫu nhiên từ 100.000 đến 10.000.000 VND
        //         'discount' => $faker->numberBetween(0, 50), // Giảm giá ngẫu nhiên từ 0% đến 50%
        //         'stock' => $faker->numberBetween(0, 100), // Số lượng tồn kho ngẫu nhiên
        //         'status' => 1,
        //         'view' => $faker->numberBetween(0, 1000), // Lượt xem ngẫu nhiên
        //         'post_date' => Carbon::now(),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }
    }
}