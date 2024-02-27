<?php

namespace App\Http\Requests\Client;

use App\Rules\ReservationDatesRules;
use App\Rules\ReservationEmailRule;
use App\Rules\ReservationFirstNameRule;
use App\Rules\ReservationLastNameRule;
use App\Rules\ReservationPhoneRule;
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
            'nom_client' => ['required', 'string', new ReservationFirstNameRule()],
            'prenoms_client' => ['required', 'string', new ReservationLastNameRule()],
            'email_client' => ['required', 'string', 'email', new ReservationEmailRule()],
            'prix_par_nuit' => ['required', new ReservationPriceRule()],
            'telephone_client' => ['required', 'string', new ReservationPhoneRule()],
            'debut_sejour' => ['required', 'date', new ReservationDatesRules()],
            'fin_sejour' => ['required', 'date']
        ];
    }
}
