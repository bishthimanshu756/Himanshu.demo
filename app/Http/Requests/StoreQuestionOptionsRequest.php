<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\PseudoTypes\True_;

class StoreQuestionOptionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'is_answer' => ['required', 'boolean'],
            'options' => ['required', 'array'],
            'options.*' => ['required','min:1', 'max:50'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'is_answer.required' => 'Please select the correct answer.',
            'is_answer.boolean' => 'Please select the valid correct answer.',
            'options.required' => 'Please fill the options.',
            'options.array' => 'Please enter valid options.',
            'options.*.required' => 'Please fill all the options.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Question',
            'options.*' => 'Options',
        ];
    }
}
