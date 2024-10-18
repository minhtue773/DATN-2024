<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInformation;

class ContactController extends Controller
{
    public function index()
    {
        // Lấy thông tin contact từ bảng contact_information
        $contactInfo = ContactInformation::first(); // Lấy bản ghi đầu tiên

        // Truyền dữ liệu sang view
        return view('contact', compact('contactInfo'));
    }
}