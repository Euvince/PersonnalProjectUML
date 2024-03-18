<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Rules\UserBirthDayRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nom' => ['required', 'string', 'max:255'],
            'sexe' => ['required'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'prenoms' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'telephone' => [
                'required', 'string',
                Rule::unique('hotels')
                ->withoutTrashed(),
            ],
            'nationnalite' => ['required', 'string',],
            'date_naissance' => ['required', 'string', new UserBirthDayRule()],
        ])->validate();

        $user = User::create([
            'nom' => $input['nom'],
            'prenoms' => $input['prenoms'],
            'date_naissance' => $input['date_naissance'],
            'sexe' => $input['sexe'],
            'nationnalite' => $input['nationnalite'],
            'email' => $input['email'],
            'telephone' => $input['telephone'],
            'password' => Hash::make($input['password']),
        ]);
        $user->roles()->sync(Role::where('name', 'Client')->first()->id);
        $user->permissions()->sync([
            Permission::where('name', 'Réserver une Chambre')->first()->id,
            Permission::where('name', 'Demander un Service')->first()->id,
        ]);

        return $user;
    }
}
