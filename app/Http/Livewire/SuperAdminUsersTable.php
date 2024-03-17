<?php

namespace App\Http\Livewire;

use App\Models\User;
use DateTime;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class SuperAdminUsersTable extends Component
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

    public function deletedUsers(array $ids) : void
    {
        User::destroy($ids);
        $this->usersChecked = [];
        session()->flash('success', "L'/Les Utilisateurs(s) a/ont bien été supprimé(s)");
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

        $users = User::query();

        if(!empty($this->nom)){
            $users = $users->where('nom', 'LIKE', "%{$this->nom}%");
        }

        if(!empty($this->nationnalite)){
            $users = $users->where('nationnalite', 'LIKE', "%{$this->nationnalite}%");
        }

        return view('livewire.super-admin-users-table', [
            'users' => $users
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20)
        ]);
    }

}

