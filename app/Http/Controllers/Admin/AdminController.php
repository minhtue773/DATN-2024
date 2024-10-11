<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        return view('admin.home');
    }

    public function login() {
        return view('admin.account.login');
    }

    public function postLogin(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:3',
        ],[
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.exists' => 'Email này không tồn tại trong hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        ]);
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'role' => 1])){
            return redirect()->route('admin.home')->with('ok', 'Đăng nhập thành công');
        }
        return redirect()->back()->with('no', 'Hãy thử đăng nhập lại');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login')->with('ok', 'Đăng xuất thành công');
    }

    public function trash() {
        return view('admin.product.trash');
    }
}
