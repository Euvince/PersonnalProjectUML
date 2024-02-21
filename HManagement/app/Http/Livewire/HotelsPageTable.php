<?php

namespace App\Http\Livewire;

use App\Models\Hotel;
use DateTime;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class HotelsPageTable extends Component
{
    use WithPagination;

    public $nom = '';

    public $commune = '';

    public $quartier = '';

    public $departement = '';

    public $arrondissement = '';

    public $orderField = 'nom';

    public $orderDirection = 'ASC';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nom' => 'nullable|string',
        'commune' => 'nullable|string',
        'quartier' => 'nullable|string',
        'departement' => 'nullable|string',
        'arrondissement' => 'nullable|string',
    ];

    public function updatedNom() : void
    {
        $this->resetPage();
    }

    public function updatedDepartement() : void
    {
        $this->resetPage();
    }

    public function updatedCommune() : void
    {
        $this->resetPage();
    }

    public function updatedArrondissement() : void
    {
        $this->resetPage();
    }

    public function updatedQuartier() : void
    {
        $this->resetPage();
    }

    public function render() : View
    {
        $this->validate();

        $hotels = Hotel::query();

        if(!empty($this->nom)){
            $hotels = $hotels->where('nom', 'LIKE', "%{$this->nom}%");
        }

        if(!empty($this->departement)){
            $hotels = $hotels->whereHas('departement', function ($query) {
                $query->where('nom', 'LIKE', "%{$this->departement}%");
            });
        }

        if(!empty($this->commune)){
            $hotels = $hotels->whereHas('commune', function ($query) {
                $query->where('nom', 'LIKE', "%{$this->commune}%");
            });
        }

        if(!empty($this->arrondissment)){
            $hotels = $hotels->whereHas('arrondissment', function ($query) {
                $query->where('nom', 'LIKE', "%{$this->arrondissment}%");
            });
        }

        if(!empty($this->quartier)){
            $hotels = $hotels->whereHas('quartier', function ($query) {
                $query->where('nom', 'LIKE', "%{$this->quartier}%");
            });
        }

        return view('livewire.hotels-page-table', [
            'hotels' => $hotels
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(15)
        ]);
    }

}
