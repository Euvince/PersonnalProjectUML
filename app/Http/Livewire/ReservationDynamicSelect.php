<?php

namespace App\Http\Livewire;

use App\Models\Chambre;
use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ReservationDynamicSelect extends Component
{

    public $price;

    public $chambres;

    public $selectedChambre;

    public Reservation $reservation;

    public function mount() : void
    {
        if (request()->routeIs('reception-personnal.reservations.create')) {
            $this->price = Chambre::where('libelle', $this->chambres->first())->first()->TypeChambre->prix_par_nuit;
        }else {
            $this->price = $this->reservation->prix_par_nuit;
            $this->selectedChambre = $this->reservation->chambre_id;
        }
        if (old('chambre_id')) {
            $this->selectedChambre = old('chambre_id');
        }
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
