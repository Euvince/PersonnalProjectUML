<?php

namespace App\Rules;

use Closure;
use App\Models\Quartier;
use Illuminate\Contracts\Validation\ValidationRule;

class SameHotelForQuartier implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $hotels = request()->route()->getName() === 'super-admin.hotels.store'
                ? Quartier::find(request()->quartier_id)->hotels
                : Quartier::find(request()->quartier_id)->hotels->where('id', '!=', request()->route()->parameter('hotel')['id']);
        $hotels->each(function ($hotels) use ($fail) {
            if (strtolower($hotels->nom) === strtolower(request()->nom)) {
                $fail('Cet Hôtel existe déjà pour le Quartier spécifié.');
            }
        });
    }
}
