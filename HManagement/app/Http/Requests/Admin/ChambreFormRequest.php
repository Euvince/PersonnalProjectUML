<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ChambreFormRequest extends FormRequest
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
            'numero' => ['required',
                Rule::unique('chambres')
                ->ignore($this->route()->parameter('chambre'))
                ->withoutTrashed(),
            ],
            'libelle' => ['required', 'string'],
            'etage' => ['required'],
            'description' => ['required', 'string'],
            'capacite' => ['required', 'string'],
            'type_chambre_id' => ['required', 'integer', 'exists:types_chambres,id']
        ];
    }
}
