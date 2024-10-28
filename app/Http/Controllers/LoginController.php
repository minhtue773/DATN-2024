<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    // Phương thức xử lý callback từ Facebook
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Kiểm tra nếu người dùng đã tồn tại trong hệ thống
            $user = User::where('facebook_id', $facebookUser->id)->first();

            if ($user) {
                // Đăng nhập người dùng
                Auth::login($user);
            } else {
                // Nếu người dùng chưa tồn tại, tạo mới và đăng nhập
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'password' => '' // Có thể là mật khẩu ngẫu nhiên
                ]);

                Auth::login($user);
            }

            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Đăng nhập thất bại');
        }
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Nếu người dùng chưa có, tạo mới
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => '', // hoặc một giá trị mặc định
            ]);
        }

        // Đăng nhập người dùng
        Auth::login($user, true);

        // Chuyển hướng đến trang chủ hoặc một trang nào đó
        return redirect('/');
    }
}
