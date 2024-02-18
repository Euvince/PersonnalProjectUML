<?php

namespace App\Rules;

use App\Models\Commune;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SameArrondissementForCommune implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $arrondissements = request()->route()->getName() === 'super-admin.arrondissements.store'
                ? Commune::find(request()->commune_id)->arrondissements
                : Commune::find(request()->commune_id)->arrondissements->where('id', '!=', request()->route()->parameter('arrondissement')['id']);
        $arrondissements->each(function ($arrondissement) use ($fail) {
            if (strtolower($arrondissement->nom) === strtolower(request()->nom)) {
                $fail('Cet Arrondissement existe déjà pour la commune spécifiée.');
            }
        });
    }
}
