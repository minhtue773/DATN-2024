<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleLogin;
use App\Http\Requests\RuleNhap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class UserAuthController extends Controller
{
    public function register()
    {
        return view('clients.register');
    }
    public function registerUser(RuleNhap $req)
    {
        $req->merge(['password' => Hash::make($req->password)]);
        try {
            User::create($req->all());
        } catch (\Throwable $th) {
            dd($th);
        }
        return  redirect()->route('login');
    }
    public function login()
    {
        return view('clients.login');
    }
    public function loginUser(RuleLogin $req)
    {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Sai mật khẩu hoặc tài khoản');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        if ($request->hasCookie('remember_token')) {
            Cookie::forget('remember_token');
        }
        return redirect('/');
    }
    public function showAccount()
    {
        $user = Auth::user();
        // Tìm người dùng theo ID
        $index1 = 0;
        // Lấy danh sách sản phẩm yêu thích của người dùng
        $favoriteProducts = $user->favoriteProducts;
        return view('clients.my_account', compact('user', 'favoriteProducts'), ['index1' => $index1]);
    }
    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5120', // tối đa 5MB
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            // Lưu ảnh mới vào thư mục 'public/images'
            $path = $request->file('image')->store('images', 'public');
            $user->image = $path;
        }

        $user->save();
        return redirect()->back()->with('success', 'Thông tin đã được cập nhật!');
    }
}
