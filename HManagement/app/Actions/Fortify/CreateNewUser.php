<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
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
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'nom' => $input['nom'],
            'prenoms' => $input['prenoms'],
            'date_naissance' => $input['date_naissance'],
            'sexe' => $input['sexe'],
            'nationnalite' => $input['nationnalite'],
            'email' => $input['email'],
            'telephone' => $input['telephone'],
            'password' => Hash::make($input['password']),
        ])->assignRole(Role::where('name', 'Client'))->sync(['Consulter une']);
    }
}
