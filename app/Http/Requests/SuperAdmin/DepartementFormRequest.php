<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DepartementFormRequest extends FormRequest
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
            'nom' => ['required', 'string',
                Rule::unique('departements')
                ->ignore($this->route()->parameter('departement'))
                ->withoutTrashed(),
            ],
            'longitude' => ['required', 'numeric'],
            'lattitude' => ['required', 'numeric'],
        ];
    }
}
