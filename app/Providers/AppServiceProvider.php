<?php


namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ProductCategory;
use App\Models\PostCategory;
use App\Models\WebsiteSetting; 
use App\Models\FavoriteProduct; // Import model FavoriteProduct
use Illuminate\Support\Facades\Auth; // Import facade Auth
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Chia sẻ dữ liệu cho tất cả các view
        View::composer('*', function ($view) {
            $categories = Cache::remember('product_categories', 60, function () {
                return ProductCategory::all(); // Lấy danh mục sản phẩm
            });

            $categoriesPost = Cache::remember('post_categories', 60, function () {
                return PostCategory::all(); // Lấy danh mục bài viết
            });

            $websiteSettings = Cache::remember('website_settings', 60, function () {
                return WebsiteSetting::all()->keyBy('setting_key'); // Lấy thiết lập website
            });

            // Lấy số lượng sản phẩm yêu thích của người dùng đã đăng nhập
            $favoriteCount = 0;
            if (Auth::check()) {
                $favoriteCount = FavoriteProduct::where('user_id', Auth::id())->count();
            }

            // Truyền dữ liệu tới tất cả các view
            $view->with('categories', $categories);
            $view->with('categoriesPost', $categoriesPost);
            $view->with('websiteSettings', $websiteSettings);
            $view->with('favoriteCount', $favoriteCount); // Truyền số lượng yêu thích
        });

        // Đặt locale cho Carbon là tiếng Việt
        Carbon::setLocale('vi');
    }

    public function register()
    {
        //
    }
}