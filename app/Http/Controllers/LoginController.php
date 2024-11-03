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
                // Download avatar and save locally
                $avatarPath = $this->downloadAndSaveAvatar($facebookUser->avatar, $facebookUser->id);

                // Create a new user if not exists
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'image' => $avatarPath,
                    'password' => bcrypt('123456dummy') // Placeholder password
                ]);
            }

            // Log the user in
            Auth::login($user);

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

            // Download avatar and save locally
            $avatarPath = $this->downloadAndSaveAvatar($googleUser->getAvatar(), $googleUser->getId());

            // Find or create a new user
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'image' => $avatarPath,
                    'password' => bcrypt('123456dummy') // Placeholder password
                ]
            );

            // Log the user in
            Auth::login($user);

            return redirect()->intended('/')->with('success', 'Đăng nhập thành công.');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Đăng nhập thất bại, vui lòng thử lại.');
        }
    }

    // Helper method to download and save avatar
    protected function downloadAndSaveAvatar($url, $userId)
    {
        // Generate a unique file name
        $filename = "user_{$userId}_" . uniqid() . '.jpg';

        // Define the path where to save the file
        $path = public_path('uploads/users/' . $filename);

        // Download and save the file
        file_put_contents($path, file_get_contents($url));

        // Return the file path to be stored in the database
        return 'uploads/users/' . $filename;
    }
}