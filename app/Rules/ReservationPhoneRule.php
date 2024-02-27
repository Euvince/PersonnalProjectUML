<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\ValidationRule;

class ReservationPhoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request()->telephone_client !== Auth::user()->telephone) {
            $fail("Le champ téléphone ne correspond pas à nos enrégistrements.");
        }
    }
}
