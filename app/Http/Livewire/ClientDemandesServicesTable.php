<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ClientDemandesServicesTable extends Component
{
    public Reservation $reservation;

    public function render()
    {
        $services = Service::query()
            ->where('chambre_id', $this->reservation->chambre_id)
            ->where('nom_client',$this->reservation->nom_client)
        /* ->get() */;
        /* dd($services); */

        return view('livewire.client-demandes-services-table', [
            'services' => $services
            ->paginate(20)
        ]);
    }
}
