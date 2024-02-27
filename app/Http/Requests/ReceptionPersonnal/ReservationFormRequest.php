<?php

namespace App\Http\Requests\ReceptionPersonnal;

use App\Rules\ReservationDatesRules;
use App\Rules\ReservationPriceRule;
use Illuminate\Foundation\Http\FormRequest;

class ReservationFormRequest extends FormRequest
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
            'nom_client' => ['required', 'string'],
            'prenoms_client' => ['required', 'string'],
            'email_client' => ['required', 'string', 'email'],
            'prix_par_nuit' => ['required', new ReservationPriceRule()],
            'telephone_client' => ['required', 'string'],
            'debut_sejour' => ['required', 'date', new ReservationDatesRules()],
            'fin_sejour' => ['required', 'date'],
            'chambre_id' => ['required', 'integer', 'exists:chambres,id'],
        ];
    }
}
