<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:post_categories,id',
            'status' => 'required|in:0,1',
            'description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được dài quá 255 ký tự.',
            'category_id.required' => 'Chuyên mục là bắt buộc.',
            'category_id.exists' => 'Chuyên mục không hợp lệ.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'description.max' => 'Mô tả không được vượt quá 500 ký tự.',
            'content.required' => 'Nội dung bài viết là bắt buộc.',
            'photo.image' => 'File tải lên phải là hình ảnh.',
            'photo.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif hoặc webp.',
            'photo.max' => 'Kích thước hình ảnh không được vượt quá 2MB.'
        ];
    }

}
