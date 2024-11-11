<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderStatusUpdatedMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();
        if($request->has('status') && $request->status != null){
            $query->where('status', $request->status);
        }
        $orders = $query->get();
        $countStatus = [
            '0' => Order::where('status',0)->count(),
            '1' => Order::where('status',1)->count(),
            '2' => Order::where('status',2)->count(),
            '3' => Order::where('status',3)->count(),
            '4' => Order::where('status',4)->count(),
            '5' => Order::where('status',5)->count()
        ];
        
        return view('admin.order.order', compact('orders', 'countStatus'));
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

    protected function updateOrderStatus(Order $order, $newStatus) {
        $order->update([
            'status' => $newStatus,
            'updated_at' => Carbon::now()
        ]);
    
        $statusMessage = '';
        switch ($newStatus) {
            case 1:
                $statusMessage = 'Đơn hàng của bạn đã được xác nhận và đang được xử lý.';
                break;
            case 2:
                $statusMessage = 'Đơn hàng của bạn đang được giao.';
                break;
            case 3:
                $statusMessage = 'Đơn hàng của bạn đã được giao thành công.';
                break;
            case 5:
                $statusMessage = 'Đơn hàng của bạn đã được hủy.';
                foreach ($order->orderDetails as $orderDetail) {
                    $product = $orderDetail->product;
                    $product->stock += $orderDetail->quantity;
                    $product->save();
                }
                break;
        }
    
        // Gửi email cho khách hàng
        Mail::to($order->user->email)->send(new OrderStatusUpdatedMail($order, $statusMessage));
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
