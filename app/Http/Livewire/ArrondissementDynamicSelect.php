<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Departement;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ArrondissementDynamicSelect extends Component
{
    public $communes;

    public $arrondissement;

    public $departements;

    public $selectedCommune;

    public $selectedDepartement;


    public function mount() : void
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

    public function updatedSelectedDepartement(int $departement_id) : void
    {
        $this->communes =
            Commune::where('departement_id', $departement_id)
            ->orderBy('nom', 'ASC')->get();
    }

    public function updatedSelectedCommune(int $commune_id) : void
    {
        $this->selectedDepartement = Commune::find($commune_id)->departement_id;
    }

    public function render() : View
    {
        return view('livewire.arrondissement-dynamic-select');
    }
}
