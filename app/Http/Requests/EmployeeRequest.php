<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:255'],
            'age' => ['required', 'integer', 'min:18'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'designation_id' => ['nullable', 'exists:designations,id'],
            'salary' => ['required', 'numeric', 'min:0'],
        ];
    }

    // Custom error messages
    public function messages(): array
    {
        return [
            'name.regex' => 'Enter the name with alphabets only.',
        ];
    }
}
