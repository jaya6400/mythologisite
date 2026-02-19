<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCultureTranslationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cultureId = $this->route('culture')->id;
        $translationId = $this->route('translation')->id;

        return [
            'language_id' => [
                'sometimes',
                'exists:languages,id',
                // Ensure language is unique for this culture, except current translation
                Rule::unique('culture_translations')
                    ->where('culture_id', $cultureId)
                    ->ignore($translationId)
            ],
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'language_id.exists' => 'Invalid language selected',
            'language_id.unique' => 'A translation for this language already exists for this culture',
            'name.max' => 'Name cannot exceed 255 characters',
            'description.max' => 'Description cannot exceed 5000 characters',
        ];
    }
}
