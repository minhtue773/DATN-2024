<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInformation;
use App\Models\Member;

class AboutController extends Controller
{
    public function index()
    {
        $index1 = 3;
        return view('clients.about',compact('index1'));
    }
}
