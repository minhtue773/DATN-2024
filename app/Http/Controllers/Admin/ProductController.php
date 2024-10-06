<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.product');
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(StoreProductRequest $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function edit()
    {
        return view('admin.product.edit');
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }

    public function trash() {
        return view('admin.product.trash');
    }
}
