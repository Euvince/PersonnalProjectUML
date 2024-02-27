<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\ValidationRule;

class ReservationLastNameRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request()->prenoms_client !== Auth::user()->prenoms) {
            $fail("Le champ prénoms ne correspond pas à nos enrégistrements.");
        }
    }
}
