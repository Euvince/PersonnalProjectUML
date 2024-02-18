<?php

namespace App\Http\Livewire;

use DateTime;
use App\Models\Commune;
use Livewire\Component;
use App\Models\Departement;
use Livewire\WithPagination;

class CommunesTable extends Component
{
    use WithPagination;

    public $nom = '';

    public $selectedDepartement;

    public $orderField = 'nom';

    public $orderDirection = 'ASC';

    public array $communesChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nom' => 'nullable|string'
    ];

    public function updatedNom()
    {
        $this->resetPage();
    }

    public function deletedCommunes(array $ids)
    {
        Commune::destroy($ids);
        $this->communesChecked = [];
        session()->flash('success', 'Le(s) Commune(s) ont bien été supprimé');
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

        $communes = Commune::query();

        if(!empty($this->nom)){
            $communes = $communes->where('nom', 'LIKE', "%{$this->nom}%");
        }

        if($this->selectedDepartement){
            $communes = $communes->where('departement_id', $this->selectedDepartement);
        }

        return view('livewire.communes-table', [
            'communes' => $communes
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20),
            'departements' => Departement::orderBy('nom', 'ASC')->get()
        ]);
    }

}
