<?php

namespace App\Http\Requests\SuperAdmin;

use App\Rules\SameQuartierForArrondissement;
use Illuminate\Foundation\Http\FormRequest;

class QuartierFormRequest extends FormRequest
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
            'arrondissement_id' => ['required', 'integer', 'exists:arrondissements,id', new SameQuartierForArrondissement()],

            'longitude' => ['required'],
            'lattitude' => ['required'],
            'nom' => ['required', 'string'],
        ];
    }
}
