<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    // Phương thức chuyển hướng đến Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Xử lý callback từ Facebook
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Kiểm tra xem user đã tồn tại chưa
            $user = User::where('facebook_id', $facebookUser->id)->first();

            if (!$user) {
                // Tạo user mới nếu chưa tồn tại
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'avatar' => $facebookUser->avatar,
                    'password' => bcrypt('123456dummy') // mật khẩu giả (hoặc không dùng)
                ]);
            }

            // Đăng nhập user
            Auth::login($user);

            return redirect()->to('/home'); // hoặc bất cứ trang nào bạn muốn
        } catch (\Exception $e) {
            return redirect()->to('/login');
        }
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Phương thức xử lý callback từ Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Tìm hoặc tạo người dùng mới
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt('123456dummy') // Không dùng mật khẩu này để đăng nhập
                ]
            );

            Auth::login($user);

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Đăng nhập thất bại, vui lòng thử lại.');
        }
    }
}
