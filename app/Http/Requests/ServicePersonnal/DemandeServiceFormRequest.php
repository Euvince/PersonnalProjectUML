<?php

namespace App\Http\Requests\ServicePersonnal;

use Illuminate\Foundation\Http\FormRequest;

class DemandeServiceFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'description' => ['required'],
            'nom_client' => ['required'],
            'email_client' => ['required', 'email'],
            'prenoms_client' => ['required'],
            'telephone_client' => ['required'],
            'type_service_id' => ['required', 'integer', 'exists:types_services,id']
        ];
    }
}
