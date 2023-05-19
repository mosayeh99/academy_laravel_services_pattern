<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'file' => 'required|file|image',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم الدورة التعليمية مطلوب.',
            'name.max' => 'اقصى عدد للحروف الخاصه باسم الدوره هو 255 حرف.',
            'file.required' => 'الصورة المصغرة للدورة مطلوبة.',
            'file.image' => 'الملف يجب ان يكون من نوع صورة.'
        ];
    }
}
