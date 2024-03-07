<?php

namespace App\Http\Livewire;

use DateTime;
use App\Models\Chambre;
use Livewire\Component;
use App\Models\TypeChambre;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class AdminChambresTable extends Component
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

    public function updatedNumero() : void
    {
        $this->resetPage();
    }

    public function deletedChambres(array $ids) : void
    {
        Chambre::destroy($ids);
        $this->chambresChecked = [];
        session()->flash('success', 'La/Les Chambre(s) a/ont bien été supprimée(s)');
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

        $chambres = Chambre::query();

        if(!empty($this->numero)){
            $chambres = $chambres->where('numero', 'LIKE', "%{$this->numero}%");
        }

        if($this->selectedTypeChambre){
            $chambres = $chambres->where('type_chambre_id', $this->selectedTypeChambre);
        }

        return view('livewire.admin-chambres-table', [
            'chambres' => $chambres
                ->where('hotel_id', Auth::user()->hotel_id)
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20),
            'typesChambres' => TypeChambre::orderBy('type', 'ASC')->get()
        ]);
    }

}
