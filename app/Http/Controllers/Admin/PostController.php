<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = PostCategory::all();
        $query = Post::query();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->get();
        return view('admin.post.post', compact('categories', 'posts'));
    }


    public function create()
    {
        $categories = PostCategory::all();
        return view('admin.post.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        if ($request->hasFile('photo')) {
            $image = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/post'), $image);
            $request->merge(['image' => $image]);
        }
        $isFeatured = $request->boolean('is_featured', false);
        $request->merge(['is_featured' => $isFeatured]);

        // Generate the slug based on the title
        $slug = \Str::slug($request->title, '-');
        $request->merge(['slug' => $slug]);

        try {
            Post::create($request->all());
            return redirect()->route('admin.post.index')->with('success', 'Thêm bài viết mới thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm bài viết mới thất bại');
        }
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $categories = PostCategory::all();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // Kiểm tra và xử lý ảnh mới nếu có
        if ($request->hasFile('photo')) {
            if ($post->image && file_exists(public_path('uploads/images/post/' . $post->image))) {
                unlink(public_path('uploads/images/post/' . $post->image));
            }
            $image = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/post'), $image);
            $request->merge(['image' => $image]);
        }

        // Tạo slug mới từ tiêu đề
        $slug = \Str::slug($request->title, '-');
        $originalSlug = $slug;
        $count = 1;

        // Kiểm tra trùng lặp slug, nếu có thì thêm số đằng sau
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $request->merge(['slug' => $slug]);

        // Kiểm tra tính năng bài viết nổi bật
        $isFeatured = $request->boolean('is_featured', false);
        $request->merge(['is_featured' => $isFeatured]);

        // Cập nhật bài viết
        try {
            $post->update($request->all());
            return redirect()->route('admin.post.index')->with('success', 'Cập nhật bài viết thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhật bài viết thất bại');
        }
    }

    public function destroy()
    {
        //
    }

    public function updateFeatured(Request $request)
    {
        $post = Post::find($request->id);
        if ($post) {
            $post->is_featured = $request->is_featured;
            $post->save();
            return response()->json(['message' => 'Cập nhật thành công!']);
        }
        return response()->json(['message' => 'Không tìm thấy danh mục!'], 404);
    }
    public function delete(Post $post)
    {
        try {
            $post->delete();
            return redirect()->back()->with('success', 'Xóa bài viết thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xóa bài viết thất bại');
        }
    }

    public function destroyBox(Request $request)
    {
        try {
            if (is_array($request->post_ids)) {
                Post::destroy($request->post_ids);
                return redirect()->back()->with('ok', 'Xóa bài viết thành công');
            }
            return redirect()->back()->with('no', 'Bạn chưa chọn bài viết nào');
        } catch (\Throwable $th) {
            return redirect()->back()->with('no', 'Xóa bài viết thất bại');
        }
    }
}
