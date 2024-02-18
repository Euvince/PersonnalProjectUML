<?php

namespace App\Http\Requests\SuperAdmin;

use App\Rules\SameHotelForQuartier;
use Illuminate\Foundation\Http\FormRequest;

class HotelFormRequest extends FormRequest
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
            'nom' => ['required', 'string', new SameHotelForQuartier()],
            'longitude' => ['required'],
            'lattitude' => ['required'],
            'adresse_postale' => ['required', 'string'],
            'email' => ['required', 'email'],
            'telephone' => ['required'],
            'directeur' => ['required'],
            'quartier_id' => ['required', 'integer', 'exists:quartiers,id'],
        ];
    }
}
