<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TypeChambreFormRequest extends FormRequest
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
            'type' => ['required', 'string',
                Rule::unique('types_chambres')
                ->ignore($this->route()->parameter('type_chambre'))
                ->withoutTrashed(),
            ],
            'prix_par_nuit' => ['required', 'numeric'],
        ];
    }
}
