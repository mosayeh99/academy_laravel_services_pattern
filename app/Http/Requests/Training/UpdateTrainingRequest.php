<?php

namespace App\Http\Requests\Training;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingRequest extends FormRequest
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
            'name' => 'required',
            'training_id' => 'required|exists:trainings,id',
            'description' => 'required',
            'time' => 'required'
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
            'name.required' => 'عنوان التدريب مطلوب.',
            'training_id.required' => 'فشل تعديل التدريب.',
            'training_id.exists' => 'فشل تعديل التدريب.',
            'description.required' => 'عن التدريب مطلوب.',
            'time.required' => 'تاريخ بدأ التدريب مطلوب.',
        ];
    }
}
