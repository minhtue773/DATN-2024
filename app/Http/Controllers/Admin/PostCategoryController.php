<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Models\PostCategory;

class PostCategoryController extends Controller
{
    public function index()
    {
        $categories = [];
        return view('admin.post-category.post-category', compact('categories'));
    }

    public function create()
    {
        //
    }

    public function store(StorePostCategoryRequest $request)
    {
        //
    }

    public function show(PostCategory $postCategory)
    {
        //
    }

    public function edit(PostCategory $postCategory)
    {
        //
    }

    public function update(UpdatePostCategoryRequest $request, PostCategory $postCategory)
    {
        //
    }

    public function destroy(PostCategory $postCategory)
    {
        //
    }
}
