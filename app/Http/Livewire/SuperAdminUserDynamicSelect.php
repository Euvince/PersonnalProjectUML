<?php

namespace App\Http\Livewire;

use App\Models\Arrondissement;
use App\Models\Commune;
use App\Models\Departement;
use App\Models\Quartier;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SuperAdminUserDynamicSelect extends Component
{

    public $hotel;

    public $quartiers;

    public $communes;

    public $departements;

    public $arrondissements;

    public $selectedQuartier;

    public $selectedCommune;

    public $selectedDepartement;

    public $selectedArrondissement;


    public function mount() : void
    {
        if(!is_null($this->hotel->quartier)){
            $this->selectedQuartier = $this->hotel->quartier_id;
            $this->selectedArrondissement = $this->hotel->quartier->arrondissement_id;
            $this->selectedCommune = $this->hotel->quartier->arrondissement->commune_id;
            $this->selectedDepartement = $this->hotel->quartier->arrondissement->commune->departement_id;
        }

        /* if(old('quartier_id')) {
            $this->selectedQuartier = old('quartier_id');
        }
        if(old('arrondissement_id')) {
            $this->quartiers = Arrondissement::find(old('arrondissement_id'))->quartiers->sortBy('nom');
            $this->arrondissements = Commune::find(old('commune_id'))->arrondissements->sortBy('nom');
            $this->selectedArrondissement = old('arrondissement_id');
        }
        if(old('commune_id')) {
            #$this->quartiers = Arrondissement::find(old('arrondissement_id'))->sortBy('nom');
            $this->arrondissements = Commune::find(old('commune_id'))->arrondissements->sortBy('nom');
            $this->communes = Departement::find(old('departement_id'))->communes->sortBy('nom');
            $this->selectedCommune = old('commune_id');
        }
        if(old('departement_id')) {
            #$this->quartiers = Arrondissement::find(old('arrondissement_id'))->sortBy('nom');
            $this->arrondissements = Commune::find(old('commune_id'))?->arrondissements->sortBy('nom');
            $this->communes = Departement::find(old('departement_id'))->communes->sortBy('nom');
            $this->selectedDepartement = old('departement_id');
        } */
    }

    public function updatedSelectedDepartement(int $departement_id) : void
    {
        $this->communes = Commune::where('departement_id', $departement_id)->orderBy('nom', 'ASC')->get();
        if($this->communes->isNotEmpty()) {
            $this->arrondissements = Arrondissement::where('commune_id', $this->communes->sortBy('nom')->first()->id)->get();
        }
        else {
            $this->arrondissements = [];
        }
        if($this->arrondissements->isNotEmpty()) {
            $this->quartiers = Quartier::where('arrondissement_id', $this->arrondissements->sortBy('nom')->first()->id)->get();
        }
        else {
            $this->quartiers = [];
        }
    }

    public function updatedSelectedCommune(int $commune_id) : void
    {
        $this->arrondissements = Arrondissement::where('commune_id', $commune_id)->orderBy('nom', 'ASC')->get();
        if($this->arrondissements->isNotEmpty()) {
            $this->quartiers = Quartier::where('arrondissement_id', $this->arrondissements->sortBy('nom')->first()->id)->get();
        }
        else {
            $this->quartiers = [];
        }
        $this->selectedDepartement = Commune::find($commune_id)->departement_id;
    }

    public function updatedSelectedArrondissement(int $arrondissement_id)
    {
        $this->quartiers = Quartier::where('arrondissement_id', $arrondissement_id)->orderBy('nom', 'ASC')->get();
        $this->selectedCommune = Arrondissement::find($arrondissement_id)->commune_id;
        $this->selectedDepartement = Commune::find($this->selectedCommune)->departement_id;
    }

    public function updatedSelectedQuartier(int $quartier_id) : void
    {
        $this->selectedArrondissement = Quartier::find($quartier_id)->arrondissement_id;
        $this->selectedCommune = Arrondissement::find($this->selectedArrondissement)->commune_id;
        $this->selectedDepartement = Commune::find($this->selectedCommune)->departement_id;
    }

    public function render() : View
    {
        return view('livewire.super-admin-user-dynamic-select');
    }

}
