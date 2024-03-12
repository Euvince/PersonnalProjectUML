<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClientReservationsTable extends Component
{
    public function render()
    {

        $reservations = Reservation::query()->where('user_id', Auth::user()->id);

        return view('livewire.client-reservations-table', [
            'reservations' => $reservations
            ->paginate(20)
        ]);
    }
}
