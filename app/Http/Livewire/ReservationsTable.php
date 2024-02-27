<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use DateTime;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ReservationsTable extends Component
{
    use WithPagination;

    public $numChambre = '';

    public $userLastName = '';

    public $userFirstName = '';

    public $orderField = 'chambre_id';

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

    public function withdrawReservations(array $ids) : void
    {
        foreach ($ids as $id) {
            Reservation::find($id)->update([
                'retire' => 1
            ]);
        }
        $this->reservationsChecked = [];
        session()->flash('success', 'Le(s) Réservation(s) ont bien été retiré');
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

        $reservations = Reservation::query()->where('retire', 0);

        if(!empty($this->numChambre)){
            $reservations = $reservations->where('chambre_id', 'LIKE', "%{$this->numChambre}%");
        }

        if(!empty($this->userLastName)){
            $reservations = $reservations->where('prenoms_client', 'LIKE', "%{$this->userLastName}%");
        }

        if(!empty($this->userFirstName)){
            $reservations = $reservations->where('nom_client', 'LIKE', "%{$this->userFirstName}%");
        }

        return view('livewire.reservations-table', [
            'reservations' => $reservations
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(15)
        ]);
    }

}
