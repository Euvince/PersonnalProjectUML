<?php

namespace App\Http\Livewire;

use DateTime;
use Livewire\Component;
use App\Models\Paiement;
use App\Models\Reservation;
use Livewire\WithPagination;
use App\Jobs\CancelReservationJob;
use App\Jobs\ConfirmReservationJob;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ReceptionPersonnalReservationsTable extends Component
{
    use WithPagination;

    public $numChambre = '';

    public $userLastName = '';

    public $userFirstName = '';

    public $orderField = 'debut_sejour';

    public $orderDirection = 'ASC';

    public array $reservationsChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        /* 'numChambre' => 'nullable', */
        'userLastName' => 'nullable|string',
        'userFirstName' => 'nullable|string',
    ];

    public function updatedChambreNum() : void
    {
        $this->resetPage();
    }

    public function updatedUserLastName() : void
    {
        $this->resetPage();
    }

    public function updatedUserFirstName() : void
    {
        $this->resetPage();
    }

    public function confirmReservations(array $ids) : void
    {
        foreach ($ids as $id) {
            $reservation = Reservation::find($id);
            $reservation->chambre->markAsOccupied();
            $reservation->markAsConfirmed();
            ConfirmReservationJob::dispatch($reservation);
        }
        $this->reservationsChecked = [];
        session()->flash('success', 'La/Les Réservation(s) a/ont bien été confirmée(s)');
    }

    public function cancelReservations(array $ids) : void
    {
        foreach ($ids as $id) {
            $reservation = Reservation::find($id);
            $reservation->delete();
            $paiement = Paiement::find($reservation->paiement->id);
            $paiement->delete();
            foreach ($paiement->factures as $facture) {
                $facture->delete();
            }
            /* ÉCRIRE LE CODE POUR REMBOURSER CHAQUE CLIENT */
            CancelReservationJob::dispatch($reservation);
        }
        $this->reservationsChecked = [];
        session()->flash('success', 'Le(s) Réservation(s) a/ont bien été annulée(s)');
    }

    public function setOrderField(string | int | DateTime  $field) : void
    {
        if($field === $this->orderField){
            $this->orderDirection = $this->orderDirection === 'ASC' ? 'DESC' : 'ASC';
        }
        else {
            $this->orderField = $field;
            $this->reset('orderDirection');
        }
    }

    public function render() : View
    {
        $this->validate();

        $reservations = Reservation::query();
        $reservations = $reservations->whereHas('chambre', function ($query) {
            $query->where('hotel_id', '=', Auth::user()->hotel_id);
        });
        if(!empty($this->numChambre)){
            $reservations = $reservations->where('chambre_id', 'LIKE', "%{$this->numChambre}%");
        }

        if(!empty($this->userLastName)){
            $reservations = $reservations->where('prenoms_client', 'LIKE', "%{$this->userLastName}%");
        }

        if(!empty($this->userFirstName)){
            $reservations = $reservations->where('nom_client', 'LIKE', "%{$this->userFirstName}%");
        }

        return view('livewire.reception-personnal-reservations-table', [
            'reservations' => $reservations
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(15)
        ]);
    }

}
