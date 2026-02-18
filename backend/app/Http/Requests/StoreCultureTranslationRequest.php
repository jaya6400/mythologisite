<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCultureTranslationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorization already handled by admin middleware
    }

    public function rules(): array
    {
        $cultureId = $this->route('culture')->id;

        return [
            'language_id' => [
                'required',
                'exists:languages,id',
                // Ensure this language doesn't already have a translation for this culture
                Rule::unique('culture_translations')
                    ->where('culture_id', $cultureId)
            ],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'language_id.required' => 'Language is required',
            'language_id.exists' => 'Invalid language selected',
            'language_id.unique' => 'A translation for this language already exists for this culture',
            'name.required' => 'Name is required',
            'name.max' => 'Name cannot exceed 255 characters',
            'description.max' => 'Description cannot exceed 5000 characters',
        ];
    }
}
