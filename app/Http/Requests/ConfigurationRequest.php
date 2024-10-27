<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'site_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'map' => 'required|url',
            'description_company' => 'required|string|max:1000',
            'facebook' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'site_name.required' => 'Tên website là bắt buộc.',
            'company_name.required' => 'Tên công ty là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'phone_number.required' => 'Hotline là bắt buộc.',
            'address.required' => 'Địa chỉ là bắt buộc.',
            'map.required' => 'Bản đồ là bắt buộc.',
            'map.url' => 'Đường dẫn bản đồ không hợp lệ.',
            'description_company.required' => 'Mô tả ngắn là bắt buộc.',
            'favicon.image' => 'Favicon phải là một file hình ảnh.',
            'favicon.mimes' => 'Favicon chỉ hỗ trợ các định dạng: jpeg, png, jpg, gif, svg và webp.',
            'favicon.max' => 'Dung lượng Favicon không được vượt quá 2MB.',
            'logo.image' => 'Logo phải là một file hình ảnh.',
            'logo.mimes' => 'Logo chỉ hỗ trợ các định dạng: jpeg, png, jpg, gif, svg và webp.',
            'logo.max' => 'Dung lượng Logo không được vượt quá 2MB.',
            'facebook.url' => 'Đường dẫn liên kết không hợp lệ.',
            'tiktok.url' => 'Đường dẫn liên kết không hợp lệ.',
            'instagram.url' => 'Đường dẫn liên kết không hợp lệ.',
            'youtube.url' => 'Đường dẫn liên kết không hợp lệ.',
            'twitter.url' => 'Đường dẫn liên kết không hợp lệ.',
            'linkedin.url' => 'Đường dẫn liên kết không hợp lệ.'
        ];
    }

}
