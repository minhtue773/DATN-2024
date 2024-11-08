<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index()
    {
        $postCategories = PostCategory::all();
        return view('admin.post-category.post-category', compact('postCategories'));
    }

    public function create()
    {
        return view('admin.post-category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:post_categories,name',
            'order_number' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ],[
            'name.required' => 'Tên chuyên mục là bắt buộc.',
            'name.string' => 'Tên chuyên mục phải là chuỗi.',
            'name.unique' => 'Tên chuyên mục đã tồn tại trong hệ thống  .',
            'order_number.required' => 'Thứ tự là bắt buộc.',
            'order_number.integer' => 'Thứ tự phải là số nguyên.',
            'order_number.min' => 'Thứ tự phải lớn hơn hoặc bằng 0.',
            'photo.image' => 'File tải lên phải là ảnh.',
            'photo.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif hoặc webp.',
            'photo.max' => 'Ảnh không được lớn hơn 2MB.'
        ]);
        if($request->hasFile('photo')){
            $image = time(). '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/post_category'), $image);
            $request->merge(['image' => $image]);
        }
        try {
            PostCategory::create($request->all());
            return redirect()->route('admin.post-category.index')->with('success','Thêm danh mục mới thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Thêm danh mục mới thất bại');
        }
    }

    public function show(PostCategory $postCategory)
    {
        //
    }

    public function edit(PostCategory $postCategory)
    {
        return view('admin.post-category.edit', compact('postCategory'));
    }

    public function update(Request $request, PostCategory $postCategory)
    {
        $request->validate([
            'name' => 'required|string|unique:post_categories,name,' . $postCategory->id,
            'order_number' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ],[
            'name.required' => 'Tên chuyên mục là bắt buộc.',
            'name.string' => 'Tên chuyên mục phải là chuỗi.',
            'name.unique' => 'Tên chuyên mục đã tồn tại trong hệ thống.',
            'order_number.required' => 'Thứ tự là bắt buộc.',
            'order_number.integer' => 'Thứ tự phải là số nguyên.',
            'order_number.min' => 'Thứ tự phải lớn hơn hoặc bằng 0.',
            'photo.image' => 'File tải lên phải là ảnh.',
            'photo.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif hoặc webp.',
            'photo.max' => 'Ảnh không được lớn hơn 2MB.'
        ]);
        if ($request->hasFile('photo')) {
            if ($postCategory->image && file_exists(public_path('uploads/images/post_category/' . $postCategory->image))) {
                unlink(public_path('uploads/images/post_category/' . $postCategory->image));
            }
            $image = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/post_category'), $image);
            $request->merge(['image' => $image]);
        }
        try {
            $postCategory->update($request->all());
            return redirect()->route('admin.post-category.index')->with('success','Cập nhật danh mục thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Cập nhật danh mục thất bại');
        }

    }

    public function destroy(PostCategory $postCategory){
    try {
        if ($postCategory->posts()->exists()) {
            return redirect()->back()->with('no', 'Vẫn còn tồn tại bài viết thuộc chuyên mục này.');
        }
        $trashedPosts = $postCategory->posts()->onlyTrashed()->get();
        foreach ($trashedPosts as $post) {
            $post->forceDelete(); 
        }
        if ($postCategory->image && file_exists(public_path('uploads/images/post_category/' . $postCategory->image))) {
            unlink(public_path('uploads/images/post_category/' . $postCategory->image));
        }
        $postCategory->delete();
        return redirect()->back()->with('success', 'Xóa chuyên mục thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('no', 'Xóa chuyên mục thất bại do lỗi hệ thống.');
        }
}


    public function updateStatus(Request $request)
    {
        $postCategory = PostCategory::find($request->id);
        if ($postCategory) {
            $postCategory->status = $request->status;
            $postCategory->save();
            return response()->json(['message' => 'Cập nhật thành công!']);
        }
        return response()->json(['message' => 'Không tìm thấy danh mục!'], 404);
    }
}
