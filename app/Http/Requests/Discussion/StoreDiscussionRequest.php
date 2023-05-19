<?php

namespace App\Http\Requests\Discussion;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscussionRequest extends FormRequest
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
            'question' => 'required',
            'video_id' => 'required|exists:videos,id'
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
            'question.required' => 'السؤال مطلوب.',
            'course_id.required' => 'فشل اضافة استفسار جديد.',
            'course_id.exists' => 'فشل اضافة استفسار جديد.'
        ];
    }
}
