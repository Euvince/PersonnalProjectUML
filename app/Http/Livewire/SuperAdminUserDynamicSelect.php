<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Commune;
use Livewire\Component;
use App\Models\Quartier;
use App\Models\Departement;
use App\Models\Arrondissement;
use App\Models\Hotel;
use Illuminate\Contracts\View\View;

class SuperAdminUserDynamicSelect extends Component
{

    public User $user;

    public $hotels;

    public $quartiers;

    public $communes;

    public $departements;

    public $arrondissements;

    public $selectedHotel;

    public $selectedQuartier;

    public $selectedCommune;

    public $selectedDepartement;

    public $selectedArrondissement;


    public function mount() : void
    {

        if(!is_null($this->user->hotel)){
            $this->selectedHotel = $this->user->hotel_id;
            $this->selectedQuartier = $this->user->hotel->quartier_id;
            $this->selectedArrondissement = $this->user->hotel->quartier->arrondissement_id;
            $this->selectedCommune = $this->user->hotel->quartier->arrondissement->commune_id;
            $this->selectedDepartement = $this->user->hotel->quartier->arrondissement->commune->departement_id;
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
        if ($this->quartiers->isNotEmpty()) {
            $this->hotels = Hotel::where('quartier_id', $this->quartiers->sortBy('nom')->first()->id)->get();
        }
        else {
            $this->hotels = [];
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
        if ($this->quartiers->isNotEmpty()) {
            $this->hotels = Hotel::where('quartier_id', $this->quartiers->sortBy('nom')->first()->id)->get();
        }
        else {
            $this->hotels = [];
        }
        $this->selectedDepartement = Commune::find($commune_id)->departement_id;
    }

    public function updatedSelectedArrondissement(int $arrondissement_id)
    {
        $this->quartiers = Quartier::where('arrondissement_id', $arrondissement_id)->orderBy('nom', 'ASC')->get();
        if($this->quartiers->isNotEmpty()) {
            $this->hotels = Hotel::where('quartier_id', $this->quartiers->sortBy('nom')->first()->id)->get();
        }
        else {
            $this->hotels = [];
        }
        $this->selectedCommune = Arrondissement::find($arrondissement_id)->commune_id;
        $this->selectedDepartement = Commune::find($this->selectedCommune)->departement_id;
    }

    public function updatedSelectedQuartier(int $quartier_id) : void
    {
        $this->hotels = Hotel::where('quartier_id', $quartier_id)->orderBy('nom', 'ASC')->get();
        $this->selectedArrondissement = Quartier::find($quartier_id)->arrondissement_id;
        $this->selectedCommune = Arrondissement::find($this->selectedArrondissement)->commune_id;
        $this->selectedDepartement = Commune::find($this->selectedCommune)->departement_id;
    }

    public function updatedSelectedHotel(int $hotel_id) : void
    {
        $this->selectedQuartier = Hotel::find($hotel_id)->quartier_id;
        $this->selectedArrondissement = Quartier::find($this->selectedQuartier)->arrondissement_id;
        $this->selectedCommune = Arrondissement::find($this->selectedArrondissement)->commune_id;
        $this->selectedDepartement = Commune::find($this->selectedCommune)->departement_id;
    }

    public function render() : View
    {
        return view('livewire.super-admin-user-dynamic-select');
    }

}
