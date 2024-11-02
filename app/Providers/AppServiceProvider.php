<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ProductCategory;
use App\Models\PostCategory;
use App\Models\WebsiteSetting; // Import model WebsiteSetting
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Truyền dữ liệu danh mục sản phẩm và thiết lập website tới tất cả các view
        View::composer('*', function ($view) {
            $categories = ProductCategory::all(); // Lấy tất cả danh mục sản phẩm
            $categoriesPost = PostCategory::all(); // Lấy tất cả danh mục bài viết
            
            // Lấy tất cả các thiết lập website
            $websiteSettings = WebsiteSetting::all()->keyBy('setting_key');

            // Truyền dữ liệu tới tất cả các view
            $view->with('categories', $categories);
            $view->with('categoriesPost', $categoriesPost);
            $view->with('websiteSettings', $websiteSettings);
        });

        // Đặt locale cho Carbon là tiếng Việt
        Carbon::setLocale('vi');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}