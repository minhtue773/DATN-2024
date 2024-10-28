<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Models\PostCategory;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    public function show(PostCategory $postCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $postCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostCategoryRequest $request, PostCategory $postCategory)
    {
        //
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
