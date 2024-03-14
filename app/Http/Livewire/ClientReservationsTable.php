<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClientReservationsTable extends Component
{
    public function render()
    {
        $reservations = Reservation::query()
            ->where('termine', 0)
            ->where('user_id', Auth::user()->id);

        return view('livewire.client-reservations-table', [
            'reservations' => $reservations
            ->orderBy('date_reservation')
            ->paginate(20)
        ]);
    }
}
