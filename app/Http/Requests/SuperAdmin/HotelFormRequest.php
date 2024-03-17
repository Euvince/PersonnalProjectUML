<?php

namespace App\Http\Requests\SuperAdmin;

use App\Rules\SameHotelForQuartier;
use Illuminate\Foundation\Http\FormRequest;

class HotelFormRequest extends FormRequest
{
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
        if(request()->routeIs('super-admin.hotels.store')){
            $pictureRule = 'required|image|max:5120';
        }elseif(request()->routeIs('super-admin.hotels.update')){
            $pictureRule = 'sometimes|image|max:5120';
        }

        return [
            'quartier_id' => ['required', 'integer', 'exists:quartiers,id'],
            'arrondissement_id' => ['required', 'integer', 'exists:arrondissments,id'],
            'commune_id' => ['required', 'integer', 'exists:communes,id'],
            'departement_id' => ['required', 'integer', 'exists:departements,id'],

            'nom' => ['required', 'string', new SameHotelForQuartier()],
            'longitude' => ['required'],
            'lattitude' => ['required'],
            'adresse_postale' => ['required', 'string'],
            'email' => ['required', 'email'],
            'telephone' => ['required'],
            'directeur' => ['required'],
            'photo' => $pictureRule
        ];
    }
}
