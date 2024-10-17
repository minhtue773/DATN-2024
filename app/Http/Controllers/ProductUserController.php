<?php

namespace App\Http\Controllers;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Product; // Nếu bạn có model Product
use App\Models\ProductImage;

class ProductUserController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách danh mục
        $categories = ProductCategory::all();

        // Lấy tham số lọc và sắp xếp từ request
        $categoryId = $request->input('category_id');
        $sortBy = $request->input('sort_by');
        $searchTerm = $request->input('search');
        $priceRange = $request->input('price_range');

        // Lọc sản phẩm theo danh mục, sắp xếp và tìm kiếm
        $query = Product::query();

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
        $products = $query->paginate(9)->appends($request->except('page'));
        $newProducts = Product::orderBy('created_at', 'desc')->take(3)->get();

       

        // Trả về view với danh sách sản phẩm, danh mục, 3 sản phẩm mới nhất và banner
        return view('shop', compact('products', 'newProducts', 'categories'));
    }
    public function detail($id = null)
    {
        // Kiểm tra xem $id có phải là một số nguyên dương hay không
        if (!is_numeric($id) || $id <= 0) {
            return redirect("/thongbao")->with("thongbao", "ID sản phẩm không hợp lệ: " . $id);
        }

        // Truy vấn sản phẩm từ cơ sở dữ liệu
        $sp = Product::find($id);

        // Kiểm tra xem sản phẩm có tồn tại không
        if (!$sp) {
            return redirect("/thongbao")->with("thongbao", "Không tìm thấy sản phẩm có ID: " . $id);
        }

        // Tính giá sale nếu discount lớn hơn 0
        $salePrice = $sp->price; // Giá gốc
        if ($sp->discount > 0) {
            $salePrice = $sp->price * (1 - $sp->discount / 100); // Tính giá sale
        }

        // Truy vấn các hình ảnh của sản phẩm
        $images = ProductImage::where('product_id', $id)->get();

        // Lấy tên thương hiệu từ ProductCategory
        $categoryName = ProductCategory::where('id', $sp->product_category_id)->value('name');

        // Truy vấn các sản phẩm liên quan và lấy hình ảnh đầu tiên của mỗi sản phẩm
        $relatedProducts = Product::where('product_category_id', $sp->product_category_id)
            ->where('id', '!=', $id)
            ->take(4) // Số lượng sản phẩm liên quan bạn muốn hiển thị
            ->get()
            ->map(function ($product) {
                // Lấy hình ảnh đầu tiên của sản phẩm
                $product->first_image = ProductImage::where('product_id', $product->id)->first();
                return $product;
            });

        // Chuyển hướng đến view và truyền dữ liệu sản phẩm, hình ảnh, sản phẩm liên quan, tên thương hiệu và giá sale
        return view('layout_user.product_detail', compact('sp', 'images', 'relatedProducts', 'categoryName', 'salePrice'));
    }
}