<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DeleteUserRequest extends FormRequest
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
            'user_id' => [
                'required',
                Rule::exists($this->role !== 'TrainingAgency' ? Str::plural($this->role) : 'training_agencies', 'id')
            ],
            'role' => [
                'required',
                Rule::in(['Student', 'Teacher', 'Admin', 'TrainingAgency']),
            ],
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
            'user_id.required' => 'فشل حذف المستخدم.',
            'user_id.exists' => 'فشل حذف المستخدم.',
            'role.required' => 'فشل حذف المستخدم.',
            'role.in' => 'فشل حذف المستخدم.',
        ];
    }
}
