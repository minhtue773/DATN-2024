<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
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

    public function updateInfo(ConfigurationRequest $request) {
        try {
            $hasChanges = false;
            if ($request->hasFile('favicon')) {
                $faviconName = time() . '_' . uniqid() . '.' . $request->favicon->extension();
                $request->favicon->move(public_path('uploads/images/favicon'), $faviconName);
                $request->merge(['img_favicon' => $faviconName]);
                $hasChanges = true;
            }
            if ($request->hasFile('logo')) {
                $logoName = time() . '_' . uniqid() . '.' . $request->logo->extension();
                $request->logo->move(public_path('uploads/images/logo'), $logoName);
                $request->merge(['img_logo' => $logoName]);
                $hasChanges = true;
            }
            foreach ($request->all() as $key => $value) {
                $setting = WebsiteSetting::where('setting_key', $key)->first();
                if (!$setting || $setting->setting_value !== $value) {
                    WebsiteSetting::updateOrCreate(['setting_key' => $key], ['setting_value' => $value]);
                    $hasChanges = true; 
                }
            }
            if ($hasChanges) {
                return redirect()->route('admin.configuration.info')->with('success', 'Thông tin website đã được cập nhật thành công.');
            } else {
                return redirect()->route('admin.configuration.info')->with('info', 'Không có thay đổi để cập nhật');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi do hệ thống, vui lòng thử lại sau!');
        }
    }
    
}
