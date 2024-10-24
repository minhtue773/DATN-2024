<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
<<<<<<< HEAD
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
=======

>>>>>>> PS34351

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.order');
    }

    public function show(Order $order)
    {
        return view('admin.order.detail', compact('order'));
    }

    public function delete(Order $order) {
        try {
            $order->delete();
            return redirect()->back()->with('success', 'Xóa đơn hàng thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xóa đơn hàng thất bại!');
        }
    }

    public function destroyBox(Request $request)
    {
<<<<<<< HEAD
        if($request->has('order_ids') && is_array($request->order_ids)){
            $deletedOrders =  Order::destroy($request->order_ids);
            if($deletedOrders > 0) {
                return redirect()->back()->with('success', 'Xóa đơn hàng thành công!');
            }else{
                return redirect()->back()->with('error', 'Xóa đơn hàng thất bại!');
            }
        }else{
            return redirect()->back()->with('no', 'Bạn chưa chọn đơn hàng nào. Hãy thử lại!');
        }
    }
=======
        return view('admin.order.detail');
            }
>>>>>>> PS34351

    protected function updateOrderStatus(Order $order, $newStatus) {
        $order->update([
            'status' => $newStatus,
            'updated_at' => Carbon::now()
        ]);
    }

    public function updateStatus(Order $order) {
        switch ($order->status) {
            case 0:
                $this->updateOrderStatus($order, 1);
                return redirect()->back()->with('success', 'Đơn hàng đã được xác nhận');
            case 1:
                $this->updateOrderStatus($order, 2);
                return redirect()->back()->with('success', 'Đơn hàng đã được chuẩn bị và giao đến khách!');
            case 2:
                $this->updateOrderStatus($order, 3);
                return redirect()->back()->with('success', 'Đơn hàng được giao thành công');
            case 3:
                $order->delete();
                return redirect()->route('admin.order.index')->with('success', 'Xóa đơn hàng thành công');
            case 4:
                $this->updateOrderStatus($order, 5);
                return redirect()->back()->with('success', 'Đơn hàng đã được hủy');
            case 5:
                $order->delete();
                return redirect()->route('admin.order.index')->with('success', 'Xóa đơn hàng thành công');
            default:
                return redirect()->back()->with('error', 'Vui lòng thử lại sau!!');
        }
    }

}
