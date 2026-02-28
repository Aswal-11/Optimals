<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
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
            'designation_id' => 'required|exists:designations,id',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
        ];
    }
}
