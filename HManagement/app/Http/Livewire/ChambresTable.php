<?php

namespace App\Http\Livewire;

use DateTime;
use App\Models\Chambre;
use Livewire\Component;
use App\Models\TypeChambre;
use Livewire\WithPagination;

class ChambresTable extends Component
{
    use WithPagination;

    public $numero = '';

    public $selectedTypeChambre;

    public $orderField = 'numero';

    public $orderDirection = 'ASC';

    public array $chambresChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'numero' => 'nullable|string'
    ];

    public function updatedNumero()
    {
        $this->resetPage();
    }

    public function deletedChambres(array $ids)
    {
        Chambre::destroy($ids);
        $this->chambresChecked = [];
        session()->flash('success', 'Le(s) Chambre(s) ont bien été supprimé');
    }

    public function setOrderField(string | int | DateTime  $field)
    {
        if($field === $this->orderField){
            $this->orderDirection = $this->orderDirection === 'ASC' ? 'DESC' : 'ASC';
        }
        else {
            $this->orderField = $field;
            $this->reset('orderDirection');
        }
    }

    public function render()
    {
        $this->validate();

        $chambres = Chambre::query();

        if(!empty($this->numero)){
            $chambres = $chambres->where('numero', 'LIKE', "%{$this->numero}%");
        }

        if($this->selectedTypeChambre){
            $chambres = $chambres->where('type_chambre_id', $this->selectedTypeChambre);
        }

        return view('livewire.chambres-table', [
            'chambres' => $chambres
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20),
            'typesChambres' => TypeChambre::orderBy('type', 'ASC')->get()
        ]);
    }

}
