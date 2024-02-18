<?php

namespace App\Http\Livewire;

use App\Models\MoyenPaiement;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

class MoyensPaiementsTable extends Component
{
    use WithPagination;

    public $moyen = '';

    public $orderField = 'moyen';

    public $orderDirection = 'ASC';

    public array $moyensChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'moyen' => 'nullable|string',
    ];

    public function updatedMoyen()
    {
        $this->resetPage();
    }

    public function deletedMoyens(array $ids)
    {
        MoyenPaiement::destroy($ids);
        $this->moyensChecked = [];
        session()->flash('success', 'Le(s) Moyen(s) de Paiement(s) ont bien été supprimé');
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

        $moyens = MoyenPaiement::query();

        if(!empty($this->moyen)){
            $moyens = $moyens->where('moyen', 'LIKE', "%{$this->moyen}%");
        }

        return view('livewire.moyens-paiements-table', [
            'moyens' => $moyens
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20)
        ]);
    }

}
