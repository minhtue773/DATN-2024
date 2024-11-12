<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderControllers extends Controller
{
    public function index()
    {
        // Kiểm tra xem người dùng có đăng nhập không
        if (Auth::check()) {
            // Lấy ID người dùng hiện tại
            $userId = Auth::id();

            // Lấy dữ liệu từ bảng `order`, `order_details`, và `product` của người dùng đã đăng nhập
            $data = Order::where('user_id', $userId)
            ->orderBy('id','desc')
                ->with(['orderDetails.product']) // Tải cả mối quan hệ product của orderDetails
                ->get();
            $index1 = 1;
            // Trả về view 'layout_user.order' và truyền dữ liệu
            return view('clients.order', compact('data', 'index1'));
        } else {
            // Chuyển hướng đến trang đăng nhập nếu người dùng chưa đăng nhập
            return redirect()->route('login');
        }
    }

    public function cancel(Request $request, $id)
    {
        $request->validate([
            'cancel_reason' => 'required|min:3', // Kiểm tra lý do hủy ít nhất 3 ký tự
        ]);
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);
    
        // Kiểm tra nếu người dùng là chủ đơn hàng
        if (Auth::id() === $order->user_id) {
            // Kiểm tra nếu có lý do hủy trong request và cập nhật vào trường 'note'
            $cancelReason = $request->input('cancel_reason', 'Không có lý do'); // Lý do hủy, mặc định nếu không có
    
            // Cập nhật trạng thái đơn hàng và lưu lý do hủy
            $order->status = 4; // Trạng thái hủy (có thể là trạng thái khác mà bạn định nghĩa)
            $order->note = $cancelReason; // Lưu lý do hủy vào note
            $order->save();
    
            // Thông báo thành công
            return redirect()->back()->with('success', 'Yêu Cầu Hủy Đơn Hàng Đã Được Gửi.');
        }
    
        // Thông báo lỗi nếu không có quyền
        return redirect()->back()->with('error', 'Bạn không có quyền hủy đơn hàng này.');
    }
    
    public function changePaymentMethod(Request $request, $id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);
    
        // Kiểm tra nếu người dùng là chủ đơn hàng
        if (Auth::id() === $order->user_id) {
            // Lấy phương thức thanh toán mới từ request
            $newPaymentMethod = $request->input('payment_method');
            
            // Kiểm tra phương thức thanh toán hợp lệ (ví dụ: 'vnpay', 'momo', 'cod', ...)
            $validPaymentMethods = ['vnpay', 'momo', 'cash']; // Bạn có thể thay đổi giá trị này theo nhu cầu của bạn
            if (in_array($newPaymentMethod, $validPaymentMethods)) {
                // Cập nhật phương thức thanh toán
                $order->payment_method = $newPaymentMethod;
                $order->save();
                
                return redirect()->back()->with('success', 'Phương thức thanh toán đã được thay đổi.');
            } else {
                return redirect()->back()->with('error', 'Phương thức thanh toán không hợp lệ.');
            }
        }
    
        // Thông báo lỗi nếu không có quyền
        return redirect()->back()->with('error', 'Bạn không có quyền thay đổi phương thức thanh toán cho đơn hàng này.');
    }
    
    

    public function restore($orderId)
{
    $order = Order::find($orderId);

    if ($order && $order->status == 4) {
        // Cập nhật trạng thái của đơn hàng thành 0 (Khôi phục)
        $order->status = 0;
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được khôi phục.');
    }

    return redirect()->back()->with('error', 'Không thể khôi phục đơn hàng.');
}


    public function show($id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id); // Gọi thêm quan hệ `product` của `orderDetails`
        $index1 = 1; // Biến đếm (nếu cần dùng)

        return view('clients.orderdetail', compact('order', 'index1'));
    }
}
