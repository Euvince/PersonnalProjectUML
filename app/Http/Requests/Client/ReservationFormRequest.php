<?php

namespace App\Http\Requests\Client;

use App\Rules\DatesRules;
use App\Rules\ReservationAlreadyExistForThisBedroomInThisPeriod;
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
            'debut_sejour' => ['required', 'date', new DatesRules()],
            'fin_sejour' => ['required', 'date']
        ];
    }
}
