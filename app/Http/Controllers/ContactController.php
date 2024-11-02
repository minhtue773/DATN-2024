<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInformation;

class ContactController extends Controller
{
    public function index()
    {
        $index1 = 4;
        return view('clients.contact', compact('index1'));
    }
}