<?php

namespace App\Http\Livewire;

use App\Models\Chambre;
use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;

class ReservationDynamicSelect extends Component
{

    public $price;

    public $chambres;

    public $selectedChambre;

    public Reservation $reservation;

    public function mount() : void
    {
        $this->price = Chambre::where('libelle', $this->chambres->first())->first()->TypeChambre->prix_par_nuit;
    }

    public function updatedSelectedChambre(int $chambre_id) : void
    {
        $this->price = Chambre::find($chambre_id)->TypeChambre->prix_par_nuit;
    }

    public function render() : View
    {
        return view('livewire.reservation-dynamic-select');
    }
}
