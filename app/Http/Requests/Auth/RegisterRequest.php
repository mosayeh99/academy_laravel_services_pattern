<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'password' => 'required|confirmed|string|min:8',
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
            'email.required' => 'البريد الالكتروني مطلوب.',
            'email.max' => 'البريد الالكتروني غير صالح.',
            'email.email' => 'البريد الالكتروني غير صالح.',
            'email.string' => 'البريد الالكتروني غير صالح.',
            'email.unique' => 'البريد الالكتروني مسجل بالفعل.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.confirmed' => 'كلمات المرور غير متطابقة.',
            'password.string' => 'كلمة المرور غير صالحة.',
            'password.min' => 'كلمة المرور يجب الا تقل عن 8 احرف.',
        ];
    }
}
