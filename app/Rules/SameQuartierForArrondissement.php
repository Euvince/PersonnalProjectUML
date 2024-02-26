<?php

namespace App\Rules;

use App\Models\Arrondissement;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SameQuartierForArrondissement implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $quartiers = request()->route()->getName() === 'super-admin.quartiers.store'
                ? Arrondissement::find(request()->arrondissement_id)->quartiers
                : Arrondissement::find(request()->arrondissement_id)->quartiers->where('id', '!=', request()->route()->parameter('quartier')['id']);
        $quartiers->each(function ($quartier) use ($fail) {
            if (strtolower($quartier->nom) === strtolower(request()->nom)) {
                $fail('Ce Quartier existe déjà pour l\'Arrondissement spécifié.');
            }
        });
    }
}
