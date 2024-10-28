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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại trong hệ thống.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'photo.image' => 'File tải lên phải là ảnh.',
            'photo.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'photo.max' => 'Ảnh không được lớn hơn 2MB.'
        ]);
        if ($request->hasFile('photo')) {
            $image = time() . '.' . $request->photo->extension();
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
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        
        $request->validate([
            'name' => 'required|unique:product_categories,name,' . $category->id . '|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại trong hệ thống.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'photo.image' => 'File tải lên phải là ảnh.',
            'photo.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'photo.max' => 'Ảnh không được lớn hơn 2MB.'
        ]);
        if ($request->hasFile('photo')) {
            if ($category->image && file_exists(public_path('uploads/ProductCategory/' . $category->image))) {
                unlink(public_path('uploads/ProductCategory/' . $category->image));
            }
            $image = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/ProductCategory'), $image);
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

            if ($category->products()->exists()) {
                return redirect()->back()->with('no', 'Vẫn còn tồn tại mô hình thuộc danh mục này.');
            }
            $trashedProducts = $category->products()->onlyTrashed()->get();
            foreach ($trashedProducts as $product) {
                $product->forceDelete(); 
            }
            if ($category->image && file_exists(public_path('uploads/images/product_category/' . $category->image))) {
                unlink(public_path('uploads/images/product_category/' . $category->image));
            }

            $category->delete();
            flash()->success('Xóa danh mục thành công');
            return redirect()->back();
        } catch (\Throwable $th) {

            flash()->error('Xóa danh mục thất bại');
            return redirect()->back();

            return redirect()->back()->with('no', "Xóa $category->name thất bại do lỗi hệ thống!");

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
