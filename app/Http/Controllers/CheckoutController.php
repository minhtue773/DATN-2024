<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DiscountCode;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $index1 = 1;
        $vouchers = DiscountCode::where('status', 'active')->get();
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with(compact('index1'))->with('error', 'Giỏ hàng trống');
        }
        $user = Auth::user();
    
        // Nếu người dùng chưa đăng nhập, lưu URL của checkout vào session và chuyển hướng đến trang đăng nhập
        if (!$user) {
            session(['checkout_url' => url()->current()]); // Lưu URL của trang checkout
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }
        //kiểm tra tồn kho
        foreach ($cart as $item) {
            $product = Product::find($item['id']); // Giả sử bạn có Model Product để lấy thông tin sản phẩm
            if (!$product || $product->stock < $item['soluong']) {
                return redirect('cart')->with('error', "Sản phẩm {$product->name} không còn đủ hàng.");
            }
            if ($product->is_hidden == 1) {
                return redirect('cart')->with('error', "Sản phẩm {$product->name} không còn bán.");
            }

        }

        $addressDetail = $tinh = $quan = $phuong = '';

        if ($user && $user->address) {
            $addressParts = explode(', ', $user->address);
            $addressDetail = $addressParts[0] ?? '';
            $phuongId = $addressParts[1] ?? '';
            $quanId = $addressParts[2] ?? '';
            $tinhId = $addressParts[3] ?? '';

            // API tên Tỉnh
            $tinh = $this->getLocationName('https://esgoo.net/api-tinhthanh/1/0.htm', $tinhId);

            // API tên Quận
            $quan = $this->getLocationName("https://esgoo.net/api-tinhthanh/2/{$tinhId}.htm", $quanId);

            // API tên Phường
            $phuong = $this->getLocationName("https://esgoo.net/api-tinhthanh/3/{$quanId}.htm", $phuongId);
        }

        return view('clients.checkout', compact('vouchers','index1', 'addressDetail', 'tinh', 'quan', 'phuong'), [
            'cart' => $cart,
            'user' => $user
        ]);
    }

    // Hàm hỗ trợ gọi API và lấy tên địa điểm
    private function getLocationName($url, $locationId)
    {
        try {
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if ($data['error'] == 0) {
                foreach ($data['data'] as $location) {
                    if ($location['id'] == $locationId) {
                        return $location['full_name'];
                    }
                }
            }
        } catch (Exception $e) {
            // Xử lý lỗi
        }

        return '';
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
        session()->forget('applied_discounts');
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

        $request->validate([
            'name' => 'required|min:3',
            'email' => ['required', 'string', 'max:255','email','ends_with:@gmail.com'],
            'phone' => 'required|digits:10',
            'addressDetail' => 'required',
        ],[
            'name.required' => 'Vui lòng nhập tên.',
            'name.min' => 'Tên phải ít nhất 3 kí tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.ends_with' => 'Email không đúng định dạng @gmail.com.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.digits' => 'Không đúng định dạng số điện thoại',
            'addressDetail.required' => 'Vui lòng nhập đầy đủ thông tin địa chỉ.',
        ]);

        $index1 = 8;
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with(compact('index1'))->with('error', 'Giỏ hàng trống');
        }


        $discounts = session('applied_discounts', []);


        $tinh = $request->input('tinh');
        $quan = $request->input('quan');
        $phuong = $request->input('phuong');
        $addressDetail = $request->input('addressDetail');

        // Kiểm tra và tạo chuỗi địa chỉ đầy đủ
        $fullAddress = $addressDetail . ', ' . $phuong . ', ' . $quan . ', ' . $tinh;

        //kiểm tra tồn kho
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product || $product->stock < $item['soluong']) {
                return redirect()->route('clients.checkout')->with('error', "Sản phẩm {$product->name} không còn đủ hàng.");
            }
        }

        $order = new Order();
        $order->user_id = auth()->id();
        $order->recipient_name = $request->input('name');
        $order->recipient_phone = $request->input('phone');
        $order->recipient_email = $request->input('email');
        if (!empty($discounts)) {
            $order->applied_discount_code = $discounts[0]['code'];
        }
        $order->recipient_address = $fullAddress;
        $order->payment_method = $request->input('payment');
        $order->total = $request->input('total');
        $order->invoice_code = 'HBZ-' . strtoupper(uniqid());
        $order->save();
        // Gữi realtime -> admin
        event(new OrderPlaced($order));

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            $product->stock -= $item['soluong'];
            $product->save();

            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item['id'];
            $order_detail->quantity = $item['soluong'];
            $order_detail->price = $item['price'];
            $order_detail->save();

        }

        if ($order->payment_method == 'vnpay') {
            return app('App\Http\Controllers\Payment\VnPayController')->createPayment($order->id, $order->total);
        }

        $appliedDiscountCodes = session('applied_discount_codes', []);
        foreach ($appliedDiscountCodes as $code) {
            $discountCode = DiscountCode::where('code', $code)->first();
            if ($discountCode) {
                $discountCode->increment('used_count');
            }
        }

        session()->forget('applied_discounts');
        session()->forget('cart');
        return redirect()->route('orders')->with(compact('index1'))->with('success', 'Đặt hàng thành công');
    }
}
