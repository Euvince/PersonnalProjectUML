<?php

namespace App\Http\Livewire;

use App\Models\User;
use DateTime;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsTable extends Component
{
    use WithPagination;

    public $nom = '';

    public $nationnalite = '';

    public $orderField = 'nom';

    public $orderDirection = 'ASC';

    public array $usersChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nom' => 'nullable|string',
        'nationnalite' => 'nullable|string',
    ];

    public function updatedNom() : void
    {
        $this->resetPage();
    }

    public function updatedNationnalite() : void
    {
        $this->resetPage();
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

        $clients = User::query();

        if(!empty($this->nom)){
            $clients = $clients->where('nom', 'LIKE', "%{$this->nom}%");
        }

        if(!empty($this->nationnalite)){
            $clients = $clients->where('nationnalite', 'LIKE', "%{$this->nationnalite}%");
        }

        return view('livewire.clients-table', [
            'clients' => $clients
                ->whereHas('roles', function ($query) {
                    $query->where('name', '=', 'Client');
                    $query->where('hotel_id', '=', NULL);
                })
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20)
        ]);
    }

}
