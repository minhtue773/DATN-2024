<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|integer|min:0|max:100', // Giảm giá không vượt quá 100%
            'stock' => 'required|integer|min:0',
            'status' => 'nullable|in:0,1',
            'description' => 'nullable|string',
            'photo' => 'required|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
            'photos.*' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max cho từng ảnh
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên mô hình là bắt buộc.',
            'name.string' => 'Tên mô hình phải là chuỗi.',
            'name.max' => 'Tên mô hình không được vượt quá 255 ký tự.',
            'product_category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
            'product_category_id.exists' => 'Danh mục sản phẩm không tồn tại.',
            'price.required' => 'Giá mô hình là bắt buộc.',
            'price.numeric' => 'Giá mô hình phải là số.',
            'price.min' => 'Giá mô hình phải lớn hơn hoặc bằng 0.',
            'discount.integer' => 'Giảm giá phải là số nguyên.',
            'discount.min' => 'Giảm giá không được nhỏ hơn 0.',
            'discount.max' => 'Giảm giá không được vượt quá 100%.',
            'stock.required' => 'Số lượng bặt buộc phải nhập.',
            'stock.integer' => 'Số lượng phải là số nguyên.',
            'stock.min' => 'Số lượng không được nhỏ hơn 0.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'description.string' => 'Mô tả phải là chuỗi.',
            'photo.required' => 'Hình ảnh sản phẩm là bắt buộc.',
            'photo.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif hoặc webp.',
            'photo.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'photos.*.mimes' => 'Ảnh liên quan phải có định dạng: jpeg, png, jpg, gif hoặc webp.',
            'photos.*.max' => 'Kích thước ảnh liên quan không được vượt quá 2MB.',
        ];
    }
}
