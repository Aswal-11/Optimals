<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'designation_id' => 'required|exists:designations,id',
            'description' => 'required|string|min:10|max:1000',
            'location' => 'required|string|min:2|max:100',
            'salary' => 'required|numeric|min:0',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
