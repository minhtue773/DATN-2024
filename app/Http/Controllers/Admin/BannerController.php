<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banner.banner');
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(StoreBannerRequest $request)
    {
        //
    }

    public function show(Banner $banner)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.banner.edit');
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        //
    }

    public function destroy(Banner $banner)
    {
        //
    }
}
