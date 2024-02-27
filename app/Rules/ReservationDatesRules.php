<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ReservationDatesRules implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Carbon::parse(request()->debut_sejour)->isPast()) {
            $fail("La date de début de séjour ne peut être antérieure à aujourd'hui.");
        }

        if (request()->debut_sejour > request()->fin_sejour) {
            $fail("La date de début de séjour doit être inférieure à celle de fin de séjour.");
        }
    }
}
