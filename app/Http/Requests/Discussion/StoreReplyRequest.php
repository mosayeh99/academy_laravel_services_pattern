<?php

namespace App\Http\Requests\Discussion;

use Illuminate\Foundation\Http\FormRequest;

class StoreReplyRequest extends FormRequest
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
            'discussion_id' => 'required|exists:discussions,id',
            'body' => 'required'
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
            'discussion_id.required' => 'فشل اضافة رد لهذا السؤال.',
            'discussion_id.exists' => 'فشل اضافة رد لهذا السؤال.',
            'reply.required' => 'الرد على المناقشة مطلوب.'
        ];
    }
}
