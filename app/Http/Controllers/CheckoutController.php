<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        $order->user_id = Auth::check() ? Auth::user()->id : null;
        $order->recipient_phone	 = $request->input('sdt');
        $order->recipient_address = $request->input('diachi');

        $order->total = 200.000;
        
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
