<?php

namespace App\Http\Requests;                                 // 1. Définir le namespace

use Illuminate\Foundation\Http\FormRequest;                // 2. Import correct
use Illuminate\Validation\Rule;

class AuthorValidate extends FormRequest                     // 3. Hériter de FormRequest
{
    /**
     * Autoriser l’usage de cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Définir les règles de validation.
     */
    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'email'          => [
                'required','email','max:255',
                Rule::unique('blog_authors','email')->ignore($this->route('id')),
            ],
            'image'          => 'nullable|image|max:2048',
            'bio'            => 'nullable|string',
            'github_handle'  => 'nullable|string|max:255',
            'twitter_handle' => 'nullable|string|max:255',
        ];
    }
}
