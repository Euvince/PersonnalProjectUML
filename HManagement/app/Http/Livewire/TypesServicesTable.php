<?php

namespace App\Http\Livewire;

use App\Models\TypeService;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

class TypesServicesTable extends Component
{
    use WithPagination;

    public $type = '';

    public $prix = '';

    public $orderField = 'type';

    public $orderDirection = 'ASC';

    public array $typesChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'type' => 'nullable|string',
        'prix' => 'nullable',
    ];

    public function updatedType()
    {
        $this->resetPage();
    }

    public function updatedPrix()
    {
        $this->resetPage();
    }

    public function deletedTypes(array $ids)
    {
        TypeService::destroy($ids);
        $this->typesChecked = [];
        session()->flash('success', 'Le(s) Type(s) de Service(s) ont bien été supprimé');
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

        $types = TypeService::query();

        if(!empty($this->type)){
            $types = $types->where('type', 'LIKE', "%{$this->type}%");
        }

        if(!empty($this->prix)){
            $types = $types->where('prix', 'LIKE', "%{$this->prix}%");
        }

        return view('livewire.types-services-table', [
            'types' => $types
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20)
        ]);
    }

}
