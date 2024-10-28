<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.post.post');
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(StorePostRequest $request)
    {

        if($request->hasFile('photo')){
            $image = time(). '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/post'),$image);
            $request->merge(['image' => $image]);
        }
        $isFeatured = $request->boolean('is_featured', false);
        $request->merge(['is_featured' => $isFeatured]);
        
        try {
            Post::create($request->all());
            return redirect()->route('admin.post.index')->with('success', 'Thêm bài viết mới thành công');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Thêm bài viết mới thất bại');
        }

    }

    public function show(Post $post)
    {
        //
    }

    public function edit()
    {
        return view('admin.blog.edit');
    }

    public function update(UpdatePostRequest $request)
    {
        //
    }

    public function destroy()
    {
        //
    }
}
