<?php

namespace App\Rules;

use App\Models\Departement;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SameCommuneForDepartement implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $communes = request()->route()->getName() === 'super-admin.communes.store'
                ? Departement::find(request()->departement_id)->communes
                : Departement::find(request()->departement_id)->communes->where('id', '!=', request()->route()->parameter('commune')['id']);
        $communes->each(function ($commune) use ($fail) {
            if (strtolower($commune->nom) === strtolower(request()->nom)) {
                $fail('Cette Commune existe déjà pour le département spécifié.');
            }
        });
    }
}
