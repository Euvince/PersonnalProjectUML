<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Validation\Rule;
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
            $pictureRule = 'required|image|max:8120';
        }elseif(request()->routeIs('super-admin.hotels.update')){
            $pictureRule = 'sometimes|image|max:8120';
        }

        return [
            'departement_id' => ['required', 'integer', 'exists:departements,id'],
            'commune_id' => ['required', 'integer', 'exists:communes,id'],
            'arrondissement_id' => ['required', 'integer', 'exists:arrondissements,id'],
            'quartier_id' => ['required', 'integer', 'exists:quartiers,id', new SameHotelForQuartier()],

            'nom' => ['required', 'string'],
            'longitude' => ['required', 'numeric'],
            'lattitude' => ['required', 'numeric'],
            'adresse_postale' => ['required', 'string'],
            'email' => [
                'required', 'email',
                Rule::unique('hotels')
                ->ignore($this->route()->parameter('hotel'))
                ->withoutTrashed(),
            ],
            'telephone' => [
                'required',
                Rule::unique('hotels')
                ->ignore($this->route()->parameter('hotel'))
                ->withoutTrashed(),
            ],
            'directeur' => ['required'],
            'photo' => $pictureRule
        ];
    }
}
