<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'user_id' => [
                'required',
                Rule::exists($this->role !== 'TrainingAgency' ? Str::plural($this->role) : 'training_agencies', 'id')
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique($this->role !== 'TrainingAgency' ? Str::plural($this->role) : 'training_agencies')->ignore($this->user_id)
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => [
                'required',
                Rule::in(['Teacher', 'Admin', 'TrainingAgency']),
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
            'name.required' => 'اسم المستخدم مطلوب.',
            'name.string' => 'اسم المستخدم غير صالح.',
            'name.max' => 'اقصى عدد للحروف الخاصه باسم الدوره هو 255 حرف.',
            'user_id.required' => 'فشل تعديل المستخدم.',
            'user_id.exists' => 'فشل تعديل المستخدم.',
            'email.required' => 'البريد الالكتروني مطلوب.',
            'email.max' => 'البريد الالكتروني غير صالح.',
            'email.string' => 'البريد الالكتروني غير صالح.',
            'email.unique' => 'البريد الالكتروني مسجل بالفعل.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.confirmed' => 'كلمات المرور غير متطابقة.',
            'password.string' => 'كلمة المرور غير صالحة.',
            'password.min' => 'كلمة المرور يجب الا تقل عن 8 احرف.',
            'role.required' => 'فشل تحديد صلاحية المستخدم.',
            'role.in' => 'فشل تحديد صلاحية المستخدم.',
        ];
    }
}
