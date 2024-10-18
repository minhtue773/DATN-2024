<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use App\Models\Post;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use DB;


class BlogController extends Controller
{
    public function __construct()
    {
        $post_cate_arr = PostCategory::where('status', 1)->get();
        \View::share('post_cate_arr', $post_cate_arr);
    }

    public function index(Request $request, $idCataPost = 0)
    {
        $per_page = env('PER_PAGE', 10); // Thiết lập số lượng bài viết mỗi trang
        $posts = Post::where('status', '1');

        $categoryPostName = "Tất cả sản phẩm"; // Giá trị mặc định cho tên danh mục

        if ($idCataPost) {
            $posts = $posts->where('category_id', $idCataPost);
            $categoryPostName = PostCategory::where('id', $idCataPost)->value('name') ?? $categoryPostName;
        }

        $posts = $posts->paginate($per_page)->appends($request->except('page'));

        return view('blogs', compact('posts', 'categoryPostName'));
    }

    // Phương thức để hiển thị một bài viết cụ thể
    public function show($id)
    {
        // Tìm bài viết theo ID
        $post = Post::findOrFail($id);

        // Trả về view hiển thị bài viết với dữ liệu bài viết được truyền vào
        return view('layout_user.single_blog', compact('post'));
    }
}