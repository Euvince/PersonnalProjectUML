<?php

namespace App\Http\Livewire;

use DateTime;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class RolesTable extends Component
{
    use WithPagination;

    public $role = '';

    public $orderField = 'name';

    public $orderDirection = 'ASC';

    public array $rolesChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'role' => 'nullable|string'
    ];

    public function updatedRole() : void
    {
        $this->resetPage();
    }

    public function deletedRoles(array $ids) : void
    {
        Role::destroy($ids);
        $this->rolesChecked = [];
        session()->flash('success', 'Le(s) Rôle(s) ont bien été supprimé');
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

        $roles = Role::query();

        if(!empty($this->role)){
            $roles = $roles->where('name', 'LIKE', "%{$this->role}%");
        }

        return view('livewire.roles-table', [
            'roles' => $roles
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20)
        ]);
    }
}
