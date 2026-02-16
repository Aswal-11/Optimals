<?php

namespace App\Http\Requests;

use App\Models\Skill;
use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
            'name' => ['required','unique:'.Skill::class.',name', 'regex:/^[A-Za-z\s]+$/', 'max:60'],
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
