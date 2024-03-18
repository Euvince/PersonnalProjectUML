<?php

namespace App\Http\Requests\SuperAdmin;

use App\Rules\SameArrondissementForCommune;
use Illuminate\Foundation\Http\FormRequest;

class ArrondissementFormRequest extends FormRequest
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
            'commune_id' => ['required', 'integer', 'exists:communes,id', new SameArrondissementForCommune()],
            'nom' => ['required', 'string'],
            'longitude' => ['required', 'numeric'],
            'lattitude' => ['required', 'numeric'],
        ];
    }
}
