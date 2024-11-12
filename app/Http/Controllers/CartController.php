<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCategory;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function cart()
    {

        $index1 = 1;
        return view('clients.cart',  compact('index1'));
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra có giỏ hàng chưa, nếu chưa có thì khởi tạo giỏ hàng
        if (is_null(session('cart'))) {
            session()->put('cart', []);
        }

        $cart = session('cart');
        $inCart = false; // Giả sử chưa có sản phẩm trong giỏ hàng

        // Kiểm tra sản phẩm đã có trong giỏ hàng hay chưa
        foreach ($cart as &$item) {
            if ($item['id'] == $request->product_id) {
                $item['soluong'] += $request->quantity;
                $inCart = true;
                break;
            }
        }

        // Nếu sản phẩm chưa có trong giỏ hàng thì thêm vào
        if (!$inCart) {
            $sp = Product::find($request->product_id);
            if ($sp) {
                // Lấy tên thương hiệu từ ProductCategory
                $categoryName = $sp->ProductCategory ? $sp->ProductCategory->name : 'Không xác định';

                // Lưu giá gốc
                $originalPrice = $sp->price;

                // Kiểm tra giảm giá, nếu `discount` là null hoặc bằng 0 thì không áp dụng giảm giá
                $finalPrice = (!is_null($sp->discount) && $sp->discount > 0)
                    ? $sp->price * (1 - $sp->discount / 100) // Nếu có giảm giá, tính giá sau khi giảm
                    : $sp->price; // Nếu không có giảm giá, giữ nguyên giá gốc

                $spItem = [
                    'id' => $sp->id,
                    'name' => $sp->name,
                    'original_price' => $originalPrice, // Lưu giá gốc
                    'price' => $finalPrice, // Lưu giá đã giảm (nếu có)
                    'hinh' => $sp->image,
                    'sale' => $sp->discount, // Giữ lại giá trị giảm giá
                    'stock' => $sp->stock,
                    'slug' => $sp->slug,
                    'soluong' => $request->quantity,
                    'category_name' => $categoryName, // Thêm tên thương hiệu vào giỏ hàng
                ];
                $cart[] = $spItem;
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Sản phẩm không tồn tại!",
                ], 404);
            }
        }

        // Cập nhật lại giỏ hàng trong session
        session()->put('cart', $cart);

        // Tạo kết quả trả về
        $kq = [
            "status" => true,
            "message" => "Đã thêm sản phẩm vào giỏ hàng!",
            "data" => session('cart'),
        ];

        return response()->json($kq, 200);
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart = session('cart', []);

        foreach ($cart as &$sp) {
            if ($sp['id'] == $id) {
                $sp['soluong'] = $request->soluong;
                break;
            }
        }

        session(['cart' => $cart]);

        $kq = [
            "status" => true,
            "message" => "Đã cập nhật giỏ hàng!",
            "data" => session('cart'),
        ];
        return response()->json($kq, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = session('cart');
        session()->forget('cart');
        array_splice($cart, $id, 1);
        session()->put('cart', $cart);
        $kq = [
            "status" => true,
            "message" => "Đã xóa phẩm khỏi giỏ hàng!",
            "data" => session('cart'),
        ];
        return response()->json($kq, 200);
    }

    public function clearCart()
    {
        session()->forget('cart');

        return response()->json([
            "status" => true,
            "message" => "Đã xóa giỏ hàng thành công!"
        ]);
    }

    public function apiCheckout(Request $request)
    {
        $cart = session('cart', []);
    
        foreach ($cart as $index => $item) {
            $product = Product::find($item['id']);
            if ($product) {
                // Tính toán giá với discount nếu có
                $actualPrice = $product->price;
                if ($product->discount > 0) {
                    $actualPrice = $product->price * (1 - $product->discount / 100);
                }
    
                // Kiểm tra và cập nhật giá trong giỏ hàng nếu khác giá hiện tại
                if ($item['price'] != $actualPrice) {
                    $cart[$index]['price'] = $actualPrice;
                }
            }
        }
    
        session(['cart' => $cart]);
    
        return response()->json(['success' => true]);
    }
    
    
}
