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

        
    return view('cart');
       
       
    }

    public function checkout(Request $request)
    {

        $order = new Order();
        $order->user_id = Auth::check() ? Auth::user()->id : null;
        $order->user_fullname = $request->input('name');
        $order->user_phone = $request->input('sdt');
        $order->user_address = $request->input('diachi');
        $order->user_email = $request->input('email');
        $order->total_money = 0;
        $order->total_quantity = 0;
        $order->save();

        foreach (session('cart') as $sp) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $sp['id']; // Sửa thành $sp['id']
            $order_detail->quantity = $sp['soluong']; // Sửa thành $sp['soluong']
            $order_detail->price = is_null($sp['sale_price']) ? $sp['price'] : $sp['sale_price']; // Sửa thành $sp['sale_price']
            $order_detail->save();
        
            $order->total_money += $order_detail->quantity * $order_detail->price;
            $order->total_quantity += $order_detail->quantity;
        }
        $order->save();

        session()->forget('cart');
        $request->session()->flash('thongbao', "Đã checkout thành công, Đơn hàng của bạn đang được xử lý");
        return redirect("/thongbao");
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
}
