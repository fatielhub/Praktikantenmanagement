<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateAttestationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'stagiaire_id' => ['required', 'integer', 'exists:stagiaires,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'stagiaire_id.required' => 'Le stagiaire est requis.',
            'stagiaire_id.exists' => 'Stagiaire sélectionné invalide.',
        ];
    }
}
