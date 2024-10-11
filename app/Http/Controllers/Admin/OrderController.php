<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use Illuminate\Http\Request;

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

    public function create()
    {
    }

    public function store(StoreOrderRequest $request)
    {
        //
    }

    public function show(Order $order)
    {
        return view('admin.order.detail', compact('order'));
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
