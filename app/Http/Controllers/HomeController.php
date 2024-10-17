<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product; // Đừng quên import model Product
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
        $categories = ProductCategory::orderBy('order_number', 'asc')->get();

        // Lấy 16 sản phẩm có lượt xem cao nhất
        $topViewedProducts = Product::orderBy('view', 'desc')->take(16)->get();
        // Lấy dữ liệu của banner
        $banners = Banner::all();
        // Lấy sản phẩm có mức giảm giá lớn nhất (giả sử bạn có trường discount_price và price)
        $topDiscountedProduct = Product::orderBy('discount', 'desc')->first();
        $latestPosts = Post::orderBy('created_at', 'desc')->take(8)->get(); // Lấy 8 bài viết mới nhất
        // Truyền danh mục và sản phẩm vào view
        return view('home', [
            'categories_dn' => $categories_dn,
            'categories' => $categories,
            'topViewedProducts' => $topViewedProducts,
            'topDiscountedProduct' => $topDiscountedProduct, // Truyền sản phẩm giảm giá vào view
            'latestPosts' => $latestPosts, // Truyền bài viết mới nhất vào view
            'banners' => $banners
        ]);
    }
}