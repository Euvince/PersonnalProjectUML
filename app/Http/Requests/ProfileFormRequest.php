<?php

namespace App\Http\Requests;

use App\Rules\UserBirthDayRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Actions\Fortify\PasswordValidationRules;

class ProfileFormRequest extends FormRequest
{

    use PasswordValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'sexe' => ['required'],
            'email' => ['required','string','email','max:255',
                Rule::unique('users')->ignore($this->route()->parameter('user'))
            ],
            'prenoms' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'telephone' => [
                'required', 'string',
                Rule::unique('users')
                ->ignore($this->route()->parameter('user'))
                ->withoutTrashed(),
            ],
            'nationnalite' => ['required', 'string',],
            'date_naissance' => ['required', 'string', new UserBirthDayRule()],
        ];
    }
}
