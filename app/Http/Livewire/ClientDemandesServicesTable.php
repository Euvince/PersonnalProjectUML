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
        /* $services = Service::query()
            ->where('chambre_id', $this->reservation->chambre_id)
            ->where('email_client',$this->reservation->email_client)
        ->get(); */

        $services = Service::query();
        $services = $services->whereHas('chambre', function ($query) {
            $query->where('chambre_id', $this->reservation->chambre_id);
            $query->whereHas('reservations', function ($query) {
                $query->where('termine', 0);
                $query->where('confirme', 1);
                $query->where('email_client', $this->reservation->email_client);
            });
        });

        return view('livewire.client-demandes-services-table', [
            'services' => $services
            ->paginate(20)
        ]);
    }
}
