<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ProductCategory;
use App\Models\PostCategory;
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
        View::composer('*', function ($view) {
            $categories = ProductCategory::all(); // Lấy tất cả danh mục sản phẩm
            $categoriespost = ProductCategory::all();
            $view->with('categoriespost', $categoriespost);
            $view->with('categories', $categories); // Truyền dữ liệu tới tất cả các view
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
