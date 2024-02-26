<?php

namespace App\Http\Livewire;

use App\Models\Chambre;
use App\Models\Hotel;
use App\Models\TypeChambre;
use DateTime;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ChambresPageTable extends Component
{
    use WithPagination;

    public $hotel;

    public $numero = '';

    public $libelle = '';

    public $capacite = '';

    public $description = '';

    public $typechambre = '';

    public $orderField = 'numero';

    public $orderDirection = 'ASC';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'numero' => 'nullable|string',
        'libelle' => 'nullable|string',
        'capacite' => 'nullable|string',
        'description' => 'nullable|string',
        'typechambre' => 'nullable|string',
    ];

    public function updatedNumero() : void
    {
        $this->resetPage();
    }

    public function updatedLibelle() : void
    {
        $this->resetPage();
    }

    public function updatedCapacite() : void
    {
        $this->resetPage();
    }

    public function updatedDescription() : void
    {
        $this->resetPage();
    }

    public function updatedTypechambre() : void
    {
        $this->resetPage();
    }

    public function render() : View
    {
        $this->validate();

        $chambres = Chambre::query()->where('hotel_id', $this->hotel->id);

        if(!empty($this->numero)){
            $chambres = $chambres->where('numero', 'LIKE', "%{$this->numero}%");
        }

        if(!empty($this->libelle)){
            $chambres = $chambres->where('libelle', 'LIKE', "%{$this->libelle}%");
        }

        if(!empty($this->capacite)){
            $chambres = $chambres->where('capacite', 'LIKE', "%{$this->capacite}%");
        }

        if(!empty($this->description)){
            $chambres = $chambres->where('description', 'LIKE', "%{$this->description}%");
        }

        if(!empty($this->typechambre)){
            $chambres = $chambres->whereHas('TypeChambre', function ($query) {
                $query->where('type', 'LIKE', "%{$this->typechambre}%");
            });
        }

        return view('livewire.chambres-page-table', [
            'chambres' => $chambres
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(21),
            /* 'types' => TypeChambre::all()->pluck('type', 'id') */
        ]);
    }

}
