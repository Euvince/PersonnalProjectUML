<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ChambreFormRequest extends FormRequest
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

        if(request()->routeIs('admin.chambres.store')){
            $pictureRule = 'required|image|max:5120';
        }elseif(request()->routeIs('admin.chambres.update')){
            $pictureRule = 'sometimes|image|max:5120';
        }

        return [
            'numero' => ['required',
                Rule::unique('chambres')
                ->ignore($this->route()->parameter('chambre'))
                ->withoutTrashed(),
            ],
            'libelle' => ['required', 'string'],
            'etage' => ['required'],
            'description' => ['required', 'string'],
            'capacite' => ['required', 'string'],
            'type_chambre_id' => ['required', 'integer', 'exists:types_chambres,id'],
            'photo' => $pictureRule
        ];
    }
}
