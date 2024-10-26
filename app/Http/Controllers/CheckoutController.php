<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\OrderDetail;

class CheckoutController extends Controller
{
    function index(){
        $cart = session('cart', []);
        $user = Auth::user();
        return view('checkout', ['cart' => $cart, 'user' => $user]);
    }

    public function order(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('thongbao', 'Giỏ hàng trống, không thể đặt hàng.');
        }

        $order = new Order();
        if (auth()->check()) {
            $order->user_id = auth()->id();
        } else {
            $order->recipient_name	 = $request->input('name');
            $order->recipient_phone	 = $request->input('phone');
            $order->recipient_email	 = $request->input('email');
            $order->recipient_address = $request->input('address');
        }

        $order->total = $request->input('total');
        
        $order->invoice_code = 'INV-' . strtoupper(uniqid());
        $order->save();

        foreach ($cart as $item) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item['id'];
            $order_detail->quantity = $item['soluong'];
            $order_detail->price = $item['price'];
            $order_detail->save();
        }

        session()->forget('cart');
        $request->session()->flash('thongbao', "Đã checkout thành công, Đơn hàng của bạn đang được xử lý");
        return redirect("/thongbao");
    }
}
