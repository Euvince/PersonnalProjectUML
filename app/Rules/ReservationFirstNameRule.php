<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\ValidationRule;

class ReservationFirstNameRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request()->nom_client !== Auth::user()->nom) {
            $fail("Le champ nom ne correspond pas à nos enrégistrements.");
        }
    }
}
