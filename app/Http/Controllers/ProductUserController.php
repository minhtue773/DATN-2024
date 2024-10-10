<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Nếu bạn có model Product

class ProductUserController extends Controller
{
    public function index()
    {
        // Lấy danh sách sản phẩm từ database
        $products = Product::all(); // Hoặc sử dụng phương thức phù hợp khác

        // Trả về view với danh sách sản phẩm
        return view('layout_user.shop', compact('products'));
    }
}