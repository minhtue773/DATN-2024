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
        //
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
