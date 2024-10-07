<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.category.category', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:product_categories|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ],[
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại trong hệ thống.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'photo.image' => 'File tải lên phải là ảnh.',
            'photo.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'photo.max' => 'Ảnh không được lớn hơn 2MB.'
        ]);
        if($request->hasFile('photo')){
            $image = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/ProductCategory'), $image);
            $request->merge(['image' => $image]);
        }
        try {
            ProductCategory::create($request->all());
            flash()->success('Thêm danh mục mới thành công');
            return redirect()->route('admin.category.index');
        } catch (\Throwable $th) {
            flash()->error('Thêm danh mục mới thất bại');
            return redirect()->back();
        }
    }

    public function show(ProductCategory $category)
    {
        //
    }

    public function edit(ProductCategory $category)
    {
        //
    }

    public function update(Request $request, ProductCategory $category)
    {
        //
    }

    public function destroy(ProductCategory $category)
    {
        //
    }
}
