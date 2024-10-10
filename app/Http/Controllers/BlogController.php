<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Model để truy xuất bài viết
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest; // Nếu bạn có yêu cầu để lưu bài viết
use App\Http\Requests\UpdatePostRequest; // Nếu bạn có yêu cầu để cập nhật bài viết

class BlogController extends Controller
{
    // Phương thức để hiển thị danh sách bài viết
    public function index()
    {
        // Lấy tất cả bài viết từ cơ sở dữ liệu
        $posts = Post::all(); // Bạn có thể áp dụng phân trang nếu cần

        return view('layout_user.blogs.index', compact('posts')); // Trả về view và truyền danh sách bài viết
    }

    // Phương thức để hiển thị một bài viết cụ thể
    public function show($id)
    {
        // Tìm bài viết theo ID
        $blog = Post::findOrFail($id);

        // Trả về view hiển thị bài viết với dữ liệu bài viết được truyền vào
        return view('layout_user.single_blog', compact('blog'));
    }
}