<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employeeId = $this->route('employee');

        return [
            'name' => ['sometimes', 'required', 'regex:/^[A-Za-z\s]+$/', 'max:255'],
            'age' => ['sometimes', 'required', 'integer', 'min:18'],
            'email' => ['sometimes', 'required', 'email', 'unique:employees,email,' . $employeeId],
            'password' => ['nullable', 'min:6', 'confirmed'],
            'designation_id' => ['nullable', 'exists:designations,id'],
            'salary' => ['sometimes', 'required', 'numeric', 'min:0', 'max:99999999.99'],
        ];
    }
}