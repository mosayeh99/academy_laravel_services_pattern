<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'name.required' => 'اسم المقالة مطلوب.',
            'name.string' => 'اسم المقالة يشمل حروف وارقام فقط.',
            'name.max' => 'اسم المقالة يجب الا يتعدى 255 حرف.',
            'body.required' => 'موضوع المقالة مطلوب',
        ];
    }
}
