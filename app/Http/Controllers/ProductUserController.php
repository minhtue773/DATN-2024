<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Product; // Nếu bạn có model Product
use App\Models\ProductImage;
use App\Models\Comment;

class ProductUserController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách danh mục
        $categories = ProductCategory::with('products')->get();

        // Lấy tham số lọc và sắp xếp từ request
        $categoryId = $request->input('category_id');
        $sortBy = $request->input('sort_by');
        $searchTerm = $request->input('search');
        $priceRange = $request->input('price_range');

        // Lọc sản phẩm theo danh mục, sắp xếp và tìm kiếm
        $query = Product::query()->where('is_hidden', 0);

        if ($categoryId) {
            $query->where('product_category_id', $categoryId);
        }

        // Lọc theo từ khóa tìm kiếm
        if ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        if ($priceRange) {
            switch ($priceRange) {
                case 'under_1m':
                    $query->where('price', '<', 1000000);
                    break;
                case '1m_to_2m':
                    $query->whereBetween('price', [1000000, 2000000]);
                    break;
                case '2m_to_5m':
                    $query->whereBetween('price', [2000000, 5000000]);
                    break;
                case '5m_to_10m':
                    $query->whereBetween('price', [5000000, 10000000]);
                    break;
                case 'above_10m':
                    $query->where('price', '>', 10000000);
                    break;
            }
        }

        if ($sortBy) {
            if ($sortBy == 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sortBy == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sortBy == 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($sortBy == 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sortBy == 'name_desc') {
                $query->orderBy('name', 'desc');
            }
        }

        // Phân trang và giữ lại các tham số lọc/sắp xếp/tìm kiếm
        $products = $query->paginate(8)->appends($request->except('page'));
        $newProducts = Product::orderBy('created_at', 'desc')->take(3)->get();


        $index1 = 2;
        // Trả về view với danh sách sản phẩm, danh mục, 3 sản phẩm mới nhất và banner
        return view('clients.shop', compact('products', 'newProducts', 'categories', 'index1'));
    }
    public function detail($slug = null)
    {
        // Lấy danh sách các danh mục
        $categories = ProductCategory::all();
        $bl = Comment::all();

        // Khởi tạo các biến mặc định
        $sp = Product::where('slug', $slug)->where('is_hidden', 0)->first();
        $salePrice = null;
        $images = [];
        $categoryName = null;
        $relatedProducts = [];
        $index1 = 1;

        // Chỉ thực hiện nếu sản phẩm tồn tại
        if ($sp) {
            // Tính giá sale nếu có giảm giá
            $salePrice = $sp->price;
            if ($sp->discount > 0) {
                $salePrice = $sp->price * (1 - $sp->discount / 100);
            }

            // Lấy danh sách hình ảnh của sản phẩm
            $images = ProductImage::where('product_id', $sp->id)->get();

            // Lấy tên danh mục của sản phẩm
            $categoryName = ProductCategory::where('id', $sp->product_category_id)->value('name');

            // Truy vấn các sản phẩm liên quan và tính giá sale nếu có
            $relatedProducts = Product::where('product_category_id', $sp->product_category_id)
                ->where('id', '!=', $sp->id)
                ->where('is_hidden', 0)
                ->take(8)
                ->get()
                ->map(function ($product) {
                    $product->sale_price = $product->discount > 0
                        ? $product->price * (1 - $product->discount / 100)
                        : $product->price;
                    return $product;
                });
        }

        // Chuyển hướng đến view và truyền dữ liệu
        return view('clients.prodetail', compact('bl','sp', 'images', 'relatedProducts', 'categoryName', 'salePrice', 'categories', 'index1'));
    }
}
