<?php

namespace App\Http\Livewire;

use App\Models\Arrondissement;
use App\Models\Commune;
use App\Models\Departement;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class QuartierDynamicSelect extends Component
{
    public $quartier;

    public $communes;

    public $departements;

    public $arrondissements;

    public $selectedCommune;

    public $selectedDepartement;

    public $selectedArrondissement;


    public function mount() : void
    {
        if(!is_null($this->quartier->arrondissement)){
            $this->selectedArrondissement = $this->quartier->arrondissement_id;
            $this->selectedCommune = $this->quartier->arrondissement->commune_id;
            $this->selectedDepartement = $this->quartier->arrondissement->commune->departement_id;
        }

        if(old('arrondissement_id')) {
            $this->selectedArrondissement = old('arrondissement_id');
        }

        if(old('commune_id')) {
            $this->arrondissements = Commune::find(old('commune_id'))->arrondissements->sortBy('nom');
            $this->communes = Departement::find(old('departement_id'))->communes->sortBy('nom');
            $this->selectedCommune = old('commune_id');
        }

        if(old('departement_id')) {
            $this->communes = Departement::find(old('departement_id'))->communes->sortBy('nom');
            $this->selectedDepartement = old('departement_id');
        }
    }

    public function updatedSelectedDepartement($departement_id) : void
    {
        $this->communes = Commune::where('departement_id', $departement_id)->orderBy('nom', 'ASC')->get();
        if($this->communes->isNotEmpty()) {
            $this->arrondissements = Arrondissement::where('commune_id', $this->communes->sortBy('nom')->first()->id)->get();
        }
        else {
            $this->arrondissements = [];
        }
    }

    public function updatedSelectedCommune($commune_id) : void
    {
        $this->arrondissements = Arrondissement::where('commune_id', $commune_id)->orderBy('nom', 'ASC')->get();
        $this->selectedDepartement = Commune::find($commune_id)->departement_id;
    }

    public function updatedSelectedArrondissement($arrondissement_id) : void
    {
        $this->selectedCommune = Arrondissement::find($arrondissement_id)->commune_id;
        $this->selectedDepartement = Commune::find($this->selectedCommune)->departement_id;
    }

    public function render() : View
    {
        return view('livewire.quartier-dynamic-select');
    }

}
