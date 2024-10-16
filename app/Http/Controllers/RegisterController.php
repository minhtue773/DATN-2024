<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'] ?? null,
            'name' => $data['name'] ?? null,
            'address' => $data['address'] ?? null,
            'role' => 'customer', // default role as customer
            'gender' => $data['gender'] ?? null,
            'status' => 1, // default status as active
            'birthday' => $data['birthday'] ?? null,
            'email_verified_at' => null,
        ]);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'name' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'gender' => ['nullable', 'in:male,female,other'],
            'birthday' => ['nullable', 'date'],
        ]);
    }
}
