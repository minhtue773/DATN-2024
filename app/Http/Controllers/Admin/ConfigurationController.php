<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index() {
        return view('admin.more.more');
    }
    public function info() {
        $settings = WebsiteSetting::all();
        $setting = $settings->pluck('setting_value', 'setting_key')->toArray();
        return view('admin.more.info.info', compact('setting'));
    }
}
