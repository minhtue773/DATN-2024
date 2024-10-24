<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInformation;
use App\Models\Member;

class AboutController extends Controller
{
    public function index()
    {
        $nember = Member::all();
        $contactInfo = ContactInformation::first(); // Lấy bản ghi đầu tiên
        return view('about', compact('contactInfo','nember'));
    }
}