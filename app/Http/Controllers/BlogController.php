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
use Carbon\Carbon;


class BlogController extends Controller
{
    public function __construct()
    {
        $post_cate_arr = PostCategory::where('status', 1)->get();
        \View::share('post_cate_arr', $post_cate_arr);
    }

    public function index(Request $request)
    {
        $post_cate = PostCategory::with('posts')->get();
        $cate_features = PostCategory::where('status', '1')->take(3)->get();
        $post_features = Post::where('status', '1')->take(4)->get();

        $post_cateId = $request->input('post_cateId');
        $searchTerm = $request->input('search');

        $query = post::query();

        if ($post_cateId) {
            $query->where('category_id', $post_cateId);
        }

        if ($searchTerm) {
            $query->where('title', 'LIKE', '%' . $searchTerm . '%');
        }

        $posts = $query->paginate(5)->appends($request->except('page'));
        $newPosts = post::orderBy('created_at', 'desc')->take(3)->get();

       
        $index1 = 3;
        return view('clients.posts', compact('posts', 'cate_features', 'post_features', 'newPosts', 'post_cate', 'index1'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id) // Loại trừ bài viết hiện tại
            ->where('status', 1) // Đảm bảo bài viết có trạng thái 'active'
            ->take(3) // Lấy 3 bài viết
            ->get();
            $post_features = Post::where('status', '1')->take(4)->get();

        $index1 = 3;
        return view('clients.postdetail', compact('post', 'post_features', 'relatedPosts', 'index1'));
    }
}