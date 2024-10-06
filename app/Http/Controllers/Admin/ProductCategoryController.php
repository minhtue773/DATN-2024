<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.category');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        //
    }

    public function show(ProductCategory $category)
    {
        //
    }

    public function edit(ProductCategory $category)
    {
        //
    }

    public function update(UpdateCategoryRequest $request, ProductCategory $category)
    {
        //
    }

    public function destroy(ProductCategory $category)
    {
        //
    }
}
