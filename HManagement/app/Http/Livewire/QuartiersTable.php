<?php

namespace App\Http\Livewire;

use DateTime;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Arrondissement;
use App\Models\Quartier;

class QuartiersTable extends Component
{
    use WithPagination;

    public $nom = '';

    public $selectedArrondissement;

    public $orderField = 'nom';

    public $orderDirection = 'ASC';

    public array $quartiersChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nom' => 'nullable|string'
    ];

    public function updatedNom()
    {
        $this->resetPage();
    }

    public function deletedQuartiers(array $ids)
    {
        Quartier::destroy($ids);
        $this->quartiersChecked = [];
        session()->flash('success', 'Le(s) Quartier(s) ont bien été supprimé');
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

        $quartiers = Quartier::query();

        if(!empty($this->nom)){
            $quartiers = $quartiers->where('nom', 'LIKE', "%{$this->nom}%");
        }

        if($this->selectedArrondissement){
            $quartiers = $quartiers->where('arrondissement_id', $this->selectedArrondissement);
        }

        return view('livewire.quartiers-table', [
            'quartiers' => $quartiers
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20),
            'arrondissements' => Arrondissement::orderBy('nom', 'ASC')->get()
        ]);
    }

}
