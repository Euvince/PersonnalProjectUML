<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ClientDemandesServicesTable extends Component
{
    public Reservation $reservation;

    public function render()
    {
        $services = $this->reservation->chambre->services
            /* ->where('chambre_id', $this->reservation->chambre_id)
            ->where('user_id', Auth::user()->id)
        ->get() */;
        dd($services);

        return view('livewire.client-demandes-services-table', [
            'servives' => $services
        ]);
    }
}
