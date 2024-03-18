<?php

namespace App\Http\Livewire;

use DateTime;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Arrondissement;
use App\Models\Commune;
use Illuminate\Contracts\View\View;

class ArrondissementsTable extends Component
{
    use WithPagination;

    public $nom = '';

    public $selectedCommune;

    public $orderField = 'nom';

    public $orderDirection = 'ASC';

    public array $arrondissementsChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nom' => 'nullable|string'
    ];

    public function updatedNom() : void
    {
        $this->resetPage();
    }

    public function deletedArrondissements(array $ids) : void
    {
        Arrondissement::destroy($ids);
        $this->arrondissementsChecked = [];
        session()->flash('success', "L'/Les Arrondissement(s) a/ont bien été supprimé(s)");
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

        $arrondissements = Arrondissement::query();

        if(!empty($this->nom)){
            $arrondissements = $arrondissements->where('nom', 'LIKE', "%{$this->nom}%");
        }

        if($this->selectedCommune){
            $arrondissements = $arrondissements->where('commune_id', $this->selectedCommune);
        }

        return view('livewire.arrondissements-table', [
            'arrondissements' => $arrondissements
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20),
            'communes' => Commune::has('arrondissements', '>=', 1)->orderBy('nom', 'ASC')->get()
        ]);
    }

}
