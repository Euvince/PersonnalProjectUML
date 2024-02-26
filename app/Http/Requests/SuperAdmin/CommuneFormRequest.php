<?php

namespace App\Http\Requests\SuperAdmin;

use App\Rules\SameCommuneForDepartement;
use Illuminate\Foundation\Http\FormRequest;

class CommuneFormRequest extends FormRequest
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
            'nom' => ['required', 'string', new SameCommuneForDepartement()],
            'longitude' => ['required'],
            'lattitude' => ['required'],
            'departement_id' => ['required', 'integer', 'exists:departements,id']
        ];
    }
}