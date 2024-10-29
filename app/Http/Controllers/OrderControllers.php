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

    public function cancel($id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);

        // Kiểm tra nếu người dùng là chủ đơn hàng
        if (Auth::id() === $order->user_id) {
            // Cập nhật trạng thái đơn hàng
            $order->status = 5; // Hoặc một trạng thái khác mà bạn muốn
            $order->save();

            // Thông báo thành công
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
        }

        // Thông báo lỗi nếu không có quyền
        return redirect()->back()->with('error', 'Bạn không có quyền hủy đơn hàng này.');
    }
}
