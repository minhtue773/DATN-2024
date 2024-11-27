<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index(Request $request){
        $query = User::query();
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $users = $query->get();
        return view('admin.user.user', compact('users'));
    }


    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:7',
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:other,male,female',
            'birthday' => 'nullable|date',
            'role' => 'required|in:customer,admin',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'name.required' => 'Tên người dùng là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại không hợp lệ.',
            'phone_number.min' => 'Số điện thoại phải có ít nhất 10 chữ số.',
            'photo.image' => 'Ảnh đại diện phải là file hình ảnh.',
            'photo.mimes' => 'Ảnh đại diện chỉ chấp nhận định dạng: jpeg, png, jpg, gif, webp.',
            'photo.max' => 'Ảnh đại diện không được lớn hơn 2MB.',
        ]);
        if ($request->hasFile('photo')){
            $image = time() . '_' . uniqid() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/images/user'), $image);
            $request->merge(['image' => $image]);
        }
        $request->merge(['password' => Hash::make($request->password)]);
        User::create($request->all());
        return redirect()->route('admin.user.index')->with('success', 'Thêm người dùng thành công');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.detail', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:7',
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:other,male,female',
            'birthday' => 'nullable|date',
            'role' => 'required|in:customer,admin',
            'status' => 'required|in:0,1,2',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ],[
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'name.required' => 'Tên người dùng là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại không hợp lệ.',
            'phone_number.min' => 'Số điện thoại phải có ít nhất 10 chữ số.',
            'photo.image' => 'Ảnh đại diện phải là file hình ảnh.',
            'photo.mimes' => 'Ảnh đại diện chỉ chấp nhận định dạng: jpeg, png, jpg, gif, webp.',
            'photo.max' => 'Ảnh đại diện không được lớn hơn 2MB.',
        ]);
        
        try {
            if (!empty($request->password)) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            if ($request->hasFile('photo')){
                if ($user->image && file_exists(public_path('uploads/images/user/' . $user->image))) {
                    unlink(public_path('uploads/images/user/' . $user->image));
                }
                $image = time() . '_' . uniqid() . '.' . $request->photo->extension();
                $request->photo->move(public_path('uploads/images/user'), $image);
                $request->merge(['image' => $image]);
            }
            $user->update(array_filter($request->all(), function ($value) {
                return !is_null($value);
            }));            
            return redirect()->route('admin.user.index')->with('success', 'Cập nhật người dùng thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhật người dùng thất bại');
        }

    }

    public function destroy(User $user)
    {
        try {
            try {
                if ($user->image && file_exists(public_path('uploads/images/user/' . $user->image))) {
                    unlink(public_path('uploads/images/user/' . $user->image));
                }
                $user->delete();
                return redirect()->back()->with('success', "Xóa người dùng {$user->name} thành công");
            } catch (\Throwable $th) {
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Xóa người dùng {$user->name} thất bại");
        }
    }
}
