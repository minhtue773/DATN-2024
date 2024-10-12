<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Nếu bạn có model Product

class ProductUserController extends Controller
{
    public function index()
    {
        // Lấy danh sách sản phẩm từ database và phân trang với mỗi trang 9 sản phẩm
        $products = Product::paginate(9); // Phân trang

        // Trả về view với danh sách sản phẩm
        return view('shop', compact('products'));
    }
}