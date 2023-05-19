<?php

namespace App\Http\Requests\Letter;

use Illuminate\Foundation\Http\FormRequest;

class StoreLetterRequest extends FormRequest
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
            'training_id' => 'required|exists:trainings,id',
            'body' => 'required',
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
            'training_id.required' => 'فشل تقديم الطلب.',
            'training_id.exists' => 'فشل تقديم الطلب.',
            'body.required' => 'عن الطالب مطلوب.',
        ];
    }
}
