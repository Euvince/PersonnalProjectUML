<?php

namespace App\Http\Livewire;

use DateTime;
use App\Models\Commune;
use Livewire\Component;
use App\Models\Departement;
use Illuminate\Contracts\View\View;
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

    public function updatedNom() : void
    {
        $this->resetPage();
    }

    public function deletedCommunes(array $ids) : void
    {
        Commune::destroy($ids);
        $this->communesChecked = [];
        session()->flash('success', 'Le/Les Commune(s) a/ont bien été supprimée(s)');
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
            'departements' => Departement::has('communes', '>=', 1)->orderBy('nom', 'ASC')->get()
        ]);
    }

}
