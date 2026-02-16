<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesignationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // Validation Rules
    public function rules(): array
    {
        return [
            'title' => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:255', 'unique:designations,title'],
            'description' => ['required', 'string'],
            'skill_id' => ['nullable', 'exists:skills,id'],
        ];
    }

    // Custom error messages
    public function messages(): array
    {
        return [
            'title.regex' => 'Enter the alphabets only.',
        ];
    }
}
