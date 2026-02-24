<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesignationUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'skill_id' => 'nullable|array',
        ];
    }
}
