<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class VnPayController extends Controller
{
    public function createPayment($orderId, $total)
    {
        $vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url = config('vnpay.vnp_Url');
        $vnp_ReturnUrl = route('vnpay.return');

        $order = Order::findOrFail($orderId);

        $vnp_TxnRef = $order->invoice_code;
        $vnp_OrderInfo = "Thanh toán hóa đơn $vnp_TxnRef";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = intval($total) * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = request()->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        ksort($inputData);

        $query = ""; // Biến lưu trữ chuỗi truy vấn (query string)
        $i = 0; // Biến đếm để kiểm tra lần đầu tiên
        $hashdata = ""; // Biến lưu trữ dữ liệu để tạo mã băm (hash data)

        // Duyệt qua từng phần tử trong mảng dữ liệu input
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                // Nếu không phải lần đầu tiên, thêm ký tự '&' trước mỗi cặp key=value
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                // Nếu là lần đầu tiên, không thêm ký tự '&'
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1; // Đánh dấu đã qua lần đầu tiên
            }
            // Xây dựng chuỗi truy vấn
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Gán chuỗi truy vấn vào URL của VNPay
        $vnp_Url = $vnp_Url . "?" . $query;

        // Kiểm tra nếu chuỗi bí mật hash secret đã được thiết lập
        if (isset($vnp_HashSecret)) {
            // Tạo mã băm bảo mật (Secure Hash) bằng cách sử dụng thuật toán SHA-512 với hash secret
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            // Thêm mã băm bảo mật vào URL để đảm bảo tính toàn vẹn của dữ liệu
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = $request->all();

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        $secureHash = hash_hmac('sha512', $hashData, config('vnpay.vnp_HashSecret'));

        if ($secureHash === $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                $order = Order::where('invoice_code', $request->vnp_TxnRef)->first();
                if ($order) {
                    $order->payment_status = 1; // Cập nhật trạng thái thành công (3: hoàn thành)
                    $order->vnp_transaction_id = $request->vnp_TransactionNo;
                    $order->vnp_response_code = $request->vnp_ResponseCode;
                    $order->vnp_bank_code = $request->vnp_BankCode;
                    $order->vnp_card_type = $request->vnp_CardType;
                    $order->save();

                }
                // Thanh toán thành công
                session()->forget('applied_discounts');
                session()->forget('cart');
                return redirect()->route('orders')->with('success', 'Đặt hàng thành công!');
            } else {
                // Thanh toán không thành công
                session()->forget('applied_discounts');
                session()->forget('cart');
                return redirect()->route('checkout')->with('error', 'Thanh toán thất bại, vui lòng thử lại!');
            }
        } else {
            // Dữ liệu không hợp lệ
            session()->forget('applied_discounts');
            session()->forget('cart');
            return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra trong quá trình xử lý giao dịch.');
        }
    }
}
