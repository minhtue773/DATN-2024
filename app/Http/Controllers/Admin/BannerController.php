<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.banner' ,compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'link' => 'nullable|url',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ],[
            'content.required' => 'Vui lòng nhập nội dung.',
            'link.url' => 'Link phải đúng định dạng',
            'photo.required' => 'Vui lòng chọn hình banner.',
            'photo.image' => 'File phải là hình ảnh.',
            'photo.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg hoặc webp.',
            'photo.max' => 'Hình ảnh không được vượt quá 2MB.'
        ]);
        try {
            if($request->hasFile('photo')){
                $imageName = time() . '_' . uniqid() . '.' . $request->photo->extension();
                $request->photo->move(public_path('uploads/images/banner'), $imageName);
                $request->merge(['image' => $imageName]);
            }
            Banner::create($request->all());
            return redirect()->route('admin.banner.index')->with('success', 'Thêm banner mới thành công');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Thêm banner mới thất bại');
        }
    }

    public function show(Banner $banner)
    {
        //
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'content' => 'required',
            'link' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ],[
            'content.required' => 'Vui lòng nhập nội dung.',
            'link.url' => 'Link phải đúng định dạng',
            'photo.image' => 'File phải là hình ảnh.',
            'photo.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg hoặc webp.',
            'photo.max' => 'Hình ảnh không được vượt quá 2MB.'
        ]);
        try {
            if ($request->hasFile('photo')) {
                if (file_exists(public_path('uploads/images/banner/'.$banner->image))) {
                    unlink(public_path('uploads/images/banner/'.$banner->image));
                }
                $imageName = time(). '_' . uniqid() . '.' . $request->photo->extension();
                $request->photo->move(public_path('uploads/images/banner'),$imageName);
                $request->merge(['image' => $imageName]);
            }
            $banner->update($request->all());
            return redirect()->route('admin.banner.index')->with('success','Cập nhật banner thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Cập nhật banner thất bại do lỗi hệ thống');
        }
    }

    public function destroy(Banner $banner)
    {
        try {
            $banner->delete();
            return redirect()->back()->with('success', 'Xóa banner thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xóa banner thất bại');
        }
    }

    public function updateStatus(Request $request)
    {
        $banner = Banner::find($request->id);
        if ($banner) {
            $banner->is_hidden = $request->is_hidden;
            $banner->save();
            return response()->json(['message' => 'Cập nhật thành công!']);
        }
        return response()->json(['message' => 'Không tìm thấy danh mục!'], 404);
    }
}
