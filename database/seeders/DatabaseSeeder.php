<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
                'gender' => $faker->randomElement(['male', 'female']), // Giới tính ngẫu nhiên
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
                'image' => rand(1, 7) . '.jpg', // Hình ảnh ngẫu nhiên từ 1.jpg đến 12.jpg
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
                    'image' => rand(1, 7) . '.jpg', // Hình ảnh từ 1.jpg đến 7.jpg
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
                'image' => '1.jpg',
                'title' => $faker->sentence(6, true),
                'description' => $faker->sentence(100),
                'content' => $faker->paragraph(5),
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $types = ['percentage', 'fixed', 'percentage_with_cap'];
        $statuses = ['active', 'expired', 'used'];

        for ($i = 0; $i < 20; $i++) {
            $type = $faker->randomElement($types);
            $maxDiscount = $type == 'percentage_with_cap' ? $faker->randomFloat(2, 10000, 100000) : null;

            DB::table('discount_codes')->insert([
                'code' => strtoupper(Str::random(10)), // Tạo mã voucher ngẫu nhiên
                'type' => $type, // Chọn loại ngẫu nhiên
                'discount' => $type == 'fixed' 
                    ? $faker->randomFloat(2, 100000, 500000) // Số tiền giảm nếu là 'fixed'
                    : $faker->randomFloat(2, 5, 50), // Phần trăm giảm nếu là 'percentage' hoặc 'percentage_with_cap'
                'max_discount' => $maxDiscount, // Giới hạn giảm giá tối đa nếu là 'percentage_with_cap'
                'quantity' => $faker->numberBetween(50, 200), // Số lượng mã có thể sử dụng
                'used_count' => $faker->numberBetween(0, 50), // Số lần mã đã được sử dụng
                'expiry_date' => Carbon::now()->addDays($faker->numberBetween(10, 365)), // Ngày hết hạn
                'status' => $faker->randomElement($statuses), // Trạng thái ngẫu nhiên
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $images = [
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '4.jpg',
        ];

        // Loop through and insert each banner
        foreach ($images as $image) {
            DB::table('banners')->insert([
                'image' => $image,
                'link' => null, // or a random link if needed
                'content' => 'Banner content for ' . basename($image),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        DB::table('website_settings')->insert([
            [
                'id' => 1,
                'setting_key' => 'site_name',
                'setting_value' => 'HobbyZone',
                'description' => 'Tên của trang web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'setting_key' => 'company_description',
                'setting_value' => 'ạhdjkahsdjyoqweiuna,msdalskdjadlks',
                'description' => 'Mô tả trang web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'setting_key' => 'company_name',
                'setting_value' => 'HobbyZone',
                'description' => 'Tên công ty',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'setting_key' => 'email',
                'setting_value' => 'hobbyzone@gmail.com',
                'description' => 'Email liên hệ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'setting_key' => 'phone_number',
                'setting_value' => '0899384048',
                'description' => 'Số điện thoại liên hệ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // ... Thêm các mục khác tương tự
        ]);
        DB::table('website_settings')->insert([
            [
                'id' => 6,
                'setting_key' => 'address',
                'setting_value' => '123 streett',
                'description' => 'Địa chỉ doanh nghiệp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'setting_key' => 'map',
                'setting_value' => 'http://localhost:8000/admin/configuration/info',
                'description' => 'Link nhúng bản đồ vị trí',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'setting_key' => 'img_favicon',
                'setting_value' => '1730020987_671e067b67cb5.jpg',
                'description' => 'Link hình favicon',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'setting_key' => 'img_logo',
                'setting_value' => '1730020945_671e0651e131e.jpg',
                'description' => 'Link hình logo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'setting_key' => 'facebook',
                'setting_value' => NULL,
                'description' => 'Link facebook',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'setting_key' => 'tiktok',
                'setting_value' => NULL,
                'description' => 'Link tiktok',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'setting_key' => 'youtube',
                'setting_value' => NULL,
                'description' => 'Link youtube',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 13,
                'setting_key' => 'instagram',
                'setting_value' => NULL,
                'description' => 'Link instagram',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 14,
                'setting_key' => 'twitter',
                'setting_value' => NULL,
                'description' => 'Link twitter',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 15,
                'setting_key' => 'linkedin',
                'setting_value' => NULL,
                'description' => 'Link linkedin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 16,
                'setting_key' => '_token',
                'setting_value' => 'RImvLFtJkLcvrMqGULW4Ma4s0HlRdB6ped8Vt1Es',
                'description' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 17,
                'setting_key' => '_method',
                'setting_value' => 'POST',
                'description' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 18,
                'setting_key' => 'description_company',
                'setting_value' => '123123',
                'description' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 19,
                'setting_key' => 'favicon',
                'setting_value' => '/private/var/folders/yx/qpqpf06x3czdx67_rg74d72h0000gn/T/php1lEroz',
                'description' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 20,
                'setting_key' => 'logo',
                'setting_value' => '/private/var/folders/yx/qpqpf06x3czdx67_rg74d72h0000gn/T/phpw5JUjw',
                'description' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 21,
                'setting_key' => 'link_map',
                'setting_value' => 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d1162.0917142442966!2d106.73140026960887!3d10.833412166535986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x31752758243c5d25%3A0xd00279024a178b70!2sCoffee%20Happy!3m2!1d10.8331322!2d106.7318303!4m5!1s0x317527d303238df1%3A0x4e42bc0930d2510c!2zMjUgxJDGsOG7nW5nIDI3LCBIaeG7h3AgQsOsbmggQ2jDoW5oLCBUaOG7pyDEkOG7qWMsIEjhu5MgQ2jDrSBNaW5o!3m2!1d10.8333953!2d106.7322406!5e1!3m2!1svi!2s!4v1730024867364!5m2!1svi!2s',
                'description' => 'Link Map',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
