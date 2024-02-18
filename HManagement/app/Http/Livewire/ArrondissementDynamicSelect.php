<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Departement;
use Livewire\Component;

class ArrondissementDynamicSelect extends Component
{
    public $communes;

    public $arrondissement;

    public $departements;

    public $selectedCommune;

    public $selectedDepartement;


    public function mount()
    {
        if(!is_null($this->arrondissement->commune)){
            $this->selectedCommune = $this->arrondissement->commune_id;
            $this->selectedDepartement = $this->arrondissement->commune->departement_id;
        }

        if(old('commune_id')) {
            $this->communes = Departement::find(old('departement_id'))->communes->sortBy('nom');
            $this->selectedCommune = old('commune_id');
        }

        if(old('departement_id')) {
            $this->selectedDepartement = old('departement_id');
        }
    }

    public function updatedSelectedDepartement($departement_id)
    {
        $this->communes =
            Commune::where('departement_id', $departement_id)
            ->orderBy('nom', 'ASC')->get();
    }

    public function updatedSelectedCommune($commune_id)
    {
        $this->selectedDepartement = Commune::find($commune_id)->departement_id;
    }

    public function render()
    {
        return view('livewire.arrondissement-dynamic-select');
    }
}
