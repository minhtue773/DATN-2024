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
