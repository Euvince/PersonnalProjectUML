<?php

namespace App\Http\Livewire;


use DateTime;
use Livewire\Component;
use App\Models\Facture;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class FacturesTable extends Component
{
    use WithPagination;

    public $userLastName = '';

    public $userFirstName = '';

    public $orderField = 'paiement_id';

    public $orderDirection = 'ASC';

    public array $facturesChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'userLastName' => 'nullable|string',
        'userFirstName' => 'nullable|string',
    ];

    public function updatedUserLastName() : void
    {
        $this->resetPage();
    }

    public function updatedUserFirstName() : void
    {
        $this->resetPage();
    }

    public function downloadFactures(array $ids) : void
    {
        foreach ($ids as $id) {

        }
        $this->facturesChecked = [];
        session()->flash('success', 'La/Les Facture(s) a/ont bien été téléchargée(s)');
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

        $factures = Facture::query();
        $factures = $factures->whereHas('paiement', function ($query) {
            $query->whereHas('reservation', function ($query) {
                $query->whereHas('chambre', function ($query) {
                    $query->where('hotel_id', Auth::user()->hotel_id);
                });
            });
        });

        if(!empty($this->userLastName)){
            $factures = $factures->where('prenoms_client', 'LIKE', "%{$this->userLastName}%");
        }

        if(!empty($this->userFirstName)){
            $factures = $factures->where('nom_client', 'LIKE', "%{$this->userFirstName}%");
        }

        return view('livewire.factures-table', [
            'factures' => $factures
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(15)
        ]);
    }

}
