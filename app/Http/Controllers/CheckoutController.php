<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    function index()
    {
        $index1 = 1;
        $cart = session('cart', []);
        $user = Auth::user();
        return view('clients.checkout',  compact('index1'), ['cart' => $cart, 'user' => $user]);
    }

    public function applyDiscountCode(Request $request)
    {
        $code = $request->input('discount_code');
        $discountCode = DiscountCode::where('code', $code)->where('status', 'active')->first();

        if (!$discountCode) {
            return redirect()->route('checkout')->with('error', 'Mã giảm giá không tồn tại hoặc đã hết hạn!');
        }

        // Kiểm tra số lượng mã còn khả dụng
        if ($discountCode->quantity <= $discountCode->used_count) {
            return redirect()->route('checkout')->with('error', 'Mã giảm giá đã hết lượt sử dụng!');
        }

        // Kiểm tra ngày hết hạn
        if ($discountCode->expiry_date < Carbon::today()) {
            $discountCode->status = 'expired';
            $discountCode->save();
            return redirect()->route('checkout')->with('error', 'Mã giảm giá đã hết hạn!');
        }

        // Tính toán giảm giá
        $cartTotal = array_sum(array_map(fn($sp) => $sp['price'] * $sp['soluong'], session('cart')));
        $discountAmount = 0;

        if ($discountCode->type == 'percentage') {
            $discountAmount = $cartTotal * ($discountCode->discount / 100);
        } elseif ($discountCode->type == 'fixed') {
            $discountAmount = $discountCode->discount;
        } elseif ($discountCode->type == 'percentage_with_cap') {
            $discountAmount = min($cartTotal * ($discountCode->discount / 100), $discountCode->max_discount);
        }

        // Lưu mã giảm giá vào session
        $appliedDiscounts = session('applied_discounts', []);
        $appliedDiscounts[] = [
            'code' => $discountCode->code,
            'discount' => $discountAmount,
            'type' => $discountCode->type,
        ];
        session(['applied_discounts' => $appliedDiscounts]);

        return redirect()->route('checkout')->with('success', 'Mã giảm giá đã được áp dụng! Giảm ' . number_format($discountAmount, 0, ',', '.') . ' ₫');
    }

    public function removeDiscountCode(Request $request)
    {
        $codeToRemove = $request->input('discount_code');
        $appliedDiscounts = session('applied_discounts', []);

        // Lọc các mã giảm giá còn lại mà không bao gồm mã muốn xóa
        $appliedDiscounts = array_filter($appliedDiscounts, function ($discount) use ($codeToRemove) {
            return $discount['code'] !== $codeToRemove;
        });

        // Cập nhật session với các mã giảm giá còn lại
        session(['applied_discounts' => $appliedDiscounts]);

        return redirect()->route('checkout')->with('success', 'Đã xóa mã giảm giá!');
    }



    public function order(Request $request)
    {
        $index1 = 1;
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('clients.checkout')->with(compact('index1'))->with('warning', 'Đặt hàng thất bại');
        }

        $order = new Order();
        if (auth()->check()) {
            $order->user_id = auth()->id();
        } else {
            $order->recipient_name     = $request->input('name');
            $order->recipient_phone     = $request->input('phone');
            $order->recipient_email     = $request->input('email');
            $order->recipient_address = $request->input('address');
        }
        $order->payment_method = $request->input('payment');
        $order->applied_discount_code = $request->input('payment');
        $order->total = $request->input('total');
        $order->invoice_code = 'HBZ-' . strtoupper(uniqid());
        $order->save();

        foreach ($cart as $item) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item['id'];
            $order_detail->quantity = $item['soluong'];
            $order_detail->price = $item['price'];
            $order_detail->save();
        }

        // Tăng số lần sử dụng mã giảm giá
        $appliedDiscounts = session('applied_discounts', []);
        foreach ($appliedDiscounts as $appliedDiscount) {
            $discountCode = DiscountCode::where('code', $appliedDiscount['code'])->first();
            if ($discountCode) {
                $discountCode->increment('used_count');
            }
        }

        // Xóa mã giảm giá khỏi session sau khi đặt hàng
        session()->forget('applied_discounts');

        session()->forget('cart');
        return redirect()->route('orders')->with(compact('index1'))->with('success', 'Đặt hàng thành công');
    }
}
