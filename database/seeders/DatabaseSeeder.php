<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Khai báo đúng namespace cho Faker
use Illuminate\Database\Seeder;
use Carbon\Carbon; // Khai báo Carbon

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

        // Tạo một instance của Faker
        $faker = Faker::create('vi_VN'); // Tạo dữ liệu tiếng Việt

        // Tạo 10 người dùng ngẫu nhiên tiếng Việt
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(), // Tên ngẫu nhiên
                'email' => $faker->unique()->safeEmail(), // Email ngẫu nhiên
                'password' => bcrypt('password'), // Mật khẩu mặc định
                'phone_number' => $faker->phoneNumber(), // Số điện thoại ngẫu nhiên
                'address' => $faker->address(), // Địa chỉ ngẫu nhiên
                'gender' => $faker->randomElement(['nam', 'nữ']), // Giới tính ngẫu nhiên
                'status' => 1, // Trạng thái mặc định
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Vòng lặp để tạo 1000 sản phẩm ngẫu nhiên
        // for ($i = 0; $i < 1000; $i++) {
        //     DB::table('products')->insert([
        //         'product_category_id' => rand(1, 4), // Danh mục ngẫu nhiên từ 1 đến 4
        //         'name' => $faker->words(3, true), // Tên ngẫu nhiên với 3 từ
        //         'description' => $faker->sentence(10), // Mô tả ngẫu nhiên
        //         'image' => $faker->imageUrl(640, 480, 'products', true), // Hình ảnh ngẫu nhiên
        //         'price' => $faker->randomFloat(2, 100000, 10000000), // Giá ngẫu nhiên
        //         'discount' => $faker->numberBetween(0, 50), // Giảm giá ngẫu nhiên
        //         'stock' => $faker->numberBetween(0, 100), // Số lượng tồn kho ngẫu nhiên
        //         'status' => 1, // Trạng thái mặc định
        //         'view' => $faker->numberBetween(0, 1000), // Lượt xem ngẫu nhiên
        //         'post_date' => Carbon::now(),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }
    }
}