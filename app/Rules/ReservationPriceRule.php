<?php

namespace App\Rules;

use Closure;
use App\Models\Chambre;
use Illuminate\Contracts\Validation\ValidationRule;

class ReservationPriceRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request()->routeIs('clients.chambres.reservation-send') ) {
            if ((float)request()->prix_par_nuit !== request()->route()->parameter('chambre')->TypeChambre->prix_par_nuit) {
                $fail("Le prix de la chambre est incorrect.");
            }
        }
        else {
            if (Chambre::find(request()->chambre_id)->TypeChambre->prix_par_nuit !== (float)request()->prix_par_nuit) {
                $fail("Le prix de la chambre est incorrect.");
            }
        }
    }
}
