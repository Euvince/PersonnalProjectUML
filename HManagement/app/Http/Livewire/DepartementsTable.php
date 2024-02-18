<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

class DepartementsTable extends Component
{
    use WithPagination;

    public $nom = '';

    public $orderField = 'nom';

    public $orderDirection = 'ASC';

    public array $departementsChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nom' => 'nullable|string'
    ];

    public function updatedNom()
    {
        $this->resetPage();
    }

    public function deletedDepartements(array $ids)
    {
        Departement::destroy($ids);
        $this->departementsChecked = [];
        session()->flash('success', 'Le(s) Départment(s) ont bien été supprimé');
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

        $departements = Departement::query();

        if(!empty($this->nom)){
            $departements = $departements->where('nom', 'LIKE', "%{$this->nom}%");
        }

        return view('livewire.departements-table', [
            'departements' => $departements
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20)
        ]);
    }

}
