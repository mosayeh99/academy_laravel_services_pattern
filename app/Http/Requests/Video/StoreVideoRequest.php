<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
            'file' => 'required|file|mimetypes:video/mp4',
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
            'name.required' => 'اسم الدرس مطلوب.',
            'name.max' => 'اقصى عدد للحروف الخاصه باسم الدرس هو 255 حرف.',
            'course_id.required' => 'فشل تعديل الدرس',
            'course_id.exists' => 'فشل تعديل الدرس',
            'file.file' => 'فيديو الدرس لم يكتمل تحميله.',
            'file.mimetypes' => 'الملف يجب ان يكون من نوع فيديو mp4',
            'file.required' => 'الصورة المصغرة للدورة مطلوبة.',
        ];
    }
}
