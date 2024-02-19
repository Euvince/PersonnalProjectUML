<?php

namespace App\Http\Livewire;

use App\Models\User;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
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

    public function updatedNom()
    {
        $this->resetPage();
    }

    public function updatedNationnalite()
    {
        $this->resetPage();
    }

    public function deletedUsers(array $ids)
    {
        User::destroy($ids);
        $this->usersChecked = [];
        session()->flash('success', 'Le(s) Utilisateurs(s) ont bien été supprimé');
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

        $users = User::query();

        if(!empty($this->nom)){
            $users = $users->where('nom', 'LIKE', "%{$this->nom}%");
        }

        if(!empty($this->nationnalite)){
            $users = $users->where('nationnalite', 'LIKE', "%{$this->nationnalite}%");
        }

        return view('livewire.users-table', [
            'users' => $users
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20)
        ]);
    }

}
