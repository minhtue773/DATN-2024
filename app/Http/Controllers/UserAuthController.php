<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class UserAuthController extends Controller
{
    public function register()
    {
        return view('layout_user.register');
    }
    public function registerUser(Request $req)
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
        return view('layout_user.login');
    }
    public function loginUser(Request $req)
    {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Sai cmnr');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function showAccount(){
        $user = Auth::user();
        return view('layout_user.my_account', compact('user'));
    }
    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user = Auth::user();
        if ($user) {
            // Kiểm tra dữ liệu trước khi lưu
            dd($user);
            $user->name = $request->name;
            $user->save();
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
        return redirect()->back()->with('success', 'Thông tin đã được cập nhật!');
    }
}
