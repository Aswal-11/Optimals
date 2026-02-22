<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Later we can add admin check
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:255'],
            'age' => ['required', 'integer', 'min:18'],
            'password' => ['required', 'min:6', 'confirmed'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'designation_id' => ['nullable', 'exists:designations,id'],
            'salary' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Enter the name with alphabets only.',
        ];
    }
}