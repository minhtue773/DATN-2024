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
        $request->validate([
            'name' => 'required|unique:product_categories|max:255',
            'order_number' => 'integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại trong hệ thống.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'order_number.integer' => 'Thứ tự phải là một số nguyên.',
            'order_number.min' => 'Thứ tự phải lớn hơn hoặc bằng 0.',
            'photo.image' => 'File tải lên phải là ảnh.',
            'photo.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif hoặc webp.',
            'photo.max' => 'Ảnh không được lớn hơn 2MB.'
        ]);
        if ($request->hasFile('photo')) {
            $image = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/product_category'), $image);
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
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        
        $request->validate([
            'name' => 'required|unique:product_categories,name,' . $category->id . '|max:255',
            'order_number' => 'integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại trong hệ thống.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'order_number.integer' => 'Thứ tự phải là một số nguyên.',
            'order_number.min' => 'Thứ tự phải lớn hơn hoặc bằng 0.',
            'photo.image' => 'File tải lên phải là ảnh.',
            'photo.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif hoặc webp.',
            'photo.max' => 'Ảnh không được lớn hơn 2MB.'
        ]);
        if ($request->hasFile('photo')) {
            if ($category->image && file_exists(public_path('uploads/images/product_category/' . $category->image))) {
                unlink(public_path('uploads/images/product_category/' . $category->image));
            }
            $image = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/product_category'), $image);
            $request->merge(['image' => $image]);
        }
        try {
            $category->update($request->all());
            flash()->success('Cập nhật danh mục thành công');
            return redirect()->route('admin.category.index');
        } catch (\Throwable $th) {
            flash()->error('Cập nhật danh mục thất bại');
            return redirect()->back();
        }
    }

    public function destroy(ProductCategory $category)
    {
        try {
            $category->delete();
            flash()->success("Xóa $category->name thành công!");
            return redirect()->back();
        } catch (\Throwable $th) {
            flash()->error("Xóa $category->name thất bại!");
            return redirect()->back();
        }
    }

    public function updateStatus(Request $request)
    {
        $category = ProductCategory::find($request->id);
        if ($category) {
            $category->status = $request->status;
            $category->save();
            return response()->json(['message' => 'Cập nhật thành công!']);
        }
        return response()->json(['message' => 'Không tìm thấy danh mục!'], 404);
    }
}
