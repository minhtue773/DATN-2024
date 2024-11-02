<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product; // Don't forget to import the Product model
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 4 danh mục sắp xếp theo order_number từ nhỏ đến cao
        $categories_dn = ProductCategory::orderBy('order_number', 'asc')->take(4)->get();

        // Lấy tất cả danh mục sắp xếp theo order_number từ nhỏ đến cao
        $categoriess = ProductCategory::withCount('products')->orderBy('order_number', 'asc')->take(6)->get();

        // Lấy 8 sản phẩm có lượt xem cao nhất
        $topViewedProducts = Product::orderBy('view', 'desc')->take(8)->get();

        // Lấy 2 sản phẩm có mức giảm giá lớn nhất
        $topDiscountedProducts = Product::orderBy('discount', 'desc')->take(2)->get();

        // Lấy 8 sản phẩm mới nhất
        $latestProducts = Product::orderBy('created_at', 'desc')->take(8)->get();

        // Lấy dữ liệu của banner
        $banners = Banner::all();

        // Lấy 8 bài viết mới nhất
        $latestPosts = Post::orderBy('created_at', 'desc')->take(8)->get();
        $index1 = 1;
        // Truyền danh mục và sản phẩm vào view
        return view('clients.home', [
            'categories_dn' => $categories_dn,
            'categoriess' => $categoriess,
            'topViewedProducts' => $topViewedProducts,
            'topDiscountedProducts' => $topDiscountedProducts, // Truyền sản phẩm giảm giá vào view
            'latestProducts' => $latestProducts, // Truyền sản phẩm mới nhất vào view
            'latestPosts' => $latestPosts, // Truyền bài viết mới nhất vào view
            'banners' => $banners,
            'index1' => $index1
        ]);
    }
}
