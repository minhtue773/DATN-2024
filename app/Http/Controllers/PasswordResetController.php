<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('clients.passwords');
    }
    // Gửi link reset password qua email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users',]);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forget-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Passwoed');
        });

        return redirect()->to(route('forgot-password'))->with("success", "Chung toi da gui email dat lai mat khau");
    }

    public function resetPassword($token)
    {
        return view('clients.new-password', compact('token'));
    }
    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:4|confirmed",
            "password_confirmation" => "required"
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$updatePassword) {
            return redirect()->to(route("reset.password"))->with("error", "Invalid");
        }
        User::where("email", $request->email)
            ->update(["password" => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(["email"=>$request->email])->delete();

        return redirect()->to(route('login'))->with("success","password reset success");
    }
}
