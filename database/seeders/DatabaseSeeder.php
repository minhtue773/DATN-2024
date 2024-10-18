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
        $faker = Faker::create('vi_VN');
        for ($i = 0; $i < 10; $i++) {

            ProductCategory::create([
                'name' => $faker->words(2, true), // Tạo tên ngẫu nhiên với 2 từ
                'order_number' => $i + 1, // Thứ tự từ 1 đến 10
                'description' => $faker->sentence(10), // Mô tả ngẫu nhiên với 10 từ
                'image' => rand(1, 7) . '.jpg', // Hình ảnh ngẫu nhiên từ 1.jpg đến 12.jpg
            ]);
        }
        // Tạo dữ liệu tiếng Việt

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
        for ($i = 0; $i < 1000; $i++) {
            // Tạo sản phẩm mới
            $productId = DB::table('products')->insertGetId([
                'product_category_id' => rand(1, 4), // Danh mục ngẫu nhiên từ 1 đến 4
                'name' => $faker->words(3, true), // Tên ngẫu nhiên với 3 từ
                'description' => $faker->sentence(10), // Mô tả ngẫu nhiên
                'image' => 'img/product/' . rand(1, 7) . '.jpg', // Hình ảnh ngẫu nhiên từ 1.jpg đến 12.jpg
                'price' => $faker->randomFloat(2, 100000, 10000000), // Giá ngẫu nhiên
                'discount' => $faker->numberBetween(0, 50), // Giảm giá ngẫu nhiên
                'stock' => $faker->numberBetween(0, 100), // Số lượng tồn kho ngẫu nhiên
                'status' => 1, // Trạng thái mặc định
                'view' => $faker->numberBetween(0, 1000), // Lượt xem ngẫu nhiên
                'post_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Thêm 4 hình ảnh cho mỗi sản phẩm
            for ($j = 1; $j <= 4; $j++) {
                DB::table('product_images')->insert([
                    'product_id' => $productId, // Liên kết với sản phẩm vừa tạo
                    'image' => 'img/product/' . rand(1, 7) . '.jpg', // Hình ảnh từ 1.jpg đến 7.jpg
                ]);
            }
        }
        for ($i = 0; $i < 10; $i++) {
            DB::table('post_categories')->insert([
                'name' => $faker->words(2, true),
                'order_number' => $i + 1,
                'status' => 1,
                'image' => 'img/blog/1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        for ($i = 0; $i < 100; $i++) {
            DB::table('posts')->insert([
                'user_id' => rand(1, 10),
                'category_id' => rand(1, 10),
                'image' => 'img/blog/1.jpg',
                'image_big' => 'img/blog/10.jpg',
                'title' => $faker->sentence(6, true),
                'description' => $faker->sentence(100),
                'content' => $faker->paragraph(5),
                'status' => 1,
                'post_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        $images = [
            'images/bg/1.jpg',
            'images/bg/2.jpg',
            'images/bg/3.jpg',
            'images/bg/4.jpg',
        ];

        // Loop through and insert each banner
        foreach ($images as $image) {
            DB::table('banners')->insert([
                'image' => $image,
                'link' => null, // or a random link if needed
                'content' => 'Banner content for ' . basename($image),
                'name' => 'Banner ' . basename($image),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        DB::table('contact_information')->insert([
            'images' => 'img/icon/favicon.png', // Hình ảnh cố định
            'describe' => $faker->sentence(10), // Mô tả ngẫu nhiên với 10 từ
            'phone_number' => $faker->phoneNumber(), // Số điện thoại ngẫu nhiên
            'link_map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.7144018435624!2d106.7292662114595!3d10.833154358098556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752758243c5d25%3A0xd00279024a178b70!2sCoffee%20Happy!5e0!3m2!1svi!2s!4v1729222863454!5m2!1svi!2s',
            'email' => $faker->unique()->safeEmail(), // Email ngẫu nhiên
            'link_facebook' => 'https://facebook.com/' . $faker->userName(), // Liên kết Facebook ngẫu nhiên
            'link_zalo' => 'https://zalo.me/' . rand(100000000, 999999999), // Liên kết Zalo ngẫu nhiên
            'slogan' => $faker->sentence(6), // Slogan ngẫu nhiên với 6 từ
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        for ($i = 0; $i < 10; $i++) {
            DB::table('members')->insert([
                'name' => $faker->name, // Tên ngẫu nhiên
                'images' => 'img/team/3.png', // Đường dẫn hình ảnh cố định
                'describe' => $faker->text(100), // Mô tả ngẫu nhiên
                'position' => $faker->word, // Vị trí ngẫu nhiên
                'link_facebook' => $faker->url, // Liên kết Facebook ngẫu nhiên
                'link_zalo' => 'https://zalo.me/' . rand(100000000, 999999999), // Liên kết Zalo ngẫu nhiên
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}