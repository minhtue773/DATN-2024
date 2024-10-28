<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;


class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.order');
    }

    public function create()
    {
        return view('admin.order.detail', compact('order'));
    }

    public function store(StoreOrderRequest $request)
    {
        //
    }

    public function show()
    {
        return view('admin.order.detail');
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
