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
}
