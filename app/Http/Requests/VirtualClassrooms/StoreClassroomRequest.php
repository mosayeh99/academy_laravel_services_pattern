<?php

namespace App\Http\Requests\VirtualClassrooms;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
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
            'meeting_time' => 'required',
            'meeting_link' => 'required|url'
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
            'name.required' => 'اسم الفصل التعليمي مطلوب.',
            'name.max' => 'اقصى عدد للحروف الخاصه باسم الفصل هو 255 حرف.',
            'meeting_time.required' => 'تاريخ بدأ الدورة مطلوب.',
            'meeting_link.required' => 'رابط دخول الفصل مطلوب.',
            'meeting_link.url' => 'رابط دخول الفصل غير صالح.',
        ];
    }
}
