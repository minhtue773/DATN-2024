<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // Redirect to Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle Facebook callback
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Check if user already exists
            $user = User::where('facebook_id', $facebookUser->id)->first();

            if (!$user) {
                $avatarPath = $this->downloadAndSaveAvatar($facebookUser->avatar, $facebookUser->id);

                // Create a new user if not exists
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'image' => $avatarPath,
                    'password' => bcrypt('placeholder_password') // Consider using a secure, random token
                ]);
            }


            Auth::login($user);
            if (session()->has('checkout_url')) {
                $checkoutUrl = session('checkout_url');
                session()->forget('checkout_url'); // Xóa URL đã lưu trong session
                return redirect($checkoutUrl);
            }
            return redirect()->to('/home')->with('success', 'Đăng nhập thành công.');
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', 'Đăng nhập thất bại, vui lòng thử lại.');
        }
    }

    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if user already exists
            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                $avatarPath = $this->downloadAndSaveAvatar($googleUser->getAvatar(), $googleUser->getId());

                // Create a new user if not exists
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'image' => $avatarPath,
                    'password' => bcrypt('placeholder_password') // Consider using a secure, random token
                ]);
            }
            Auth::login($user);
            if (session()->has('checkout_url')) {
                $checkoutUrl = session('checkout_url');
                session()->forget('checkout_url'); // Xóa URL đã lưu trong session
                return redirect($checkoutUrl);
            }
            

            return redirect()->intended('/')->with('success', 'Đăng nhập thành công.');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Đăng nhập thất bại, vui lòng thử lại.');
        }
    }

    // Helper method to download and save avatar
    protected function downloadAndSaveAvatar($url, $userId)
    {
        try {
            // Generate a unique file name
            $filename = "user_{$userId}_" . uniqid() . '.jpg';
            $directory = public_path('uploads/users');

            // Ensure the directory exists
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $path = $directory . '/' . $filename;

            // Download and save the file
            file_put_contents($path, file_get_contents($url));

            return 'uploads/users/' . $filename;
        } catch (\Exception $e) {
            // Return a default avatar if download fails
            return 'uploads/users/default_avatar.jpg';
        }
    }
}
