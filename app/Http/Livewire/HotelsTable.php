<?php

namespace App\Http\Livewire;

use DateTime;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Hotel;
use App\Models\Quartier;
use Illuminate\Contracts\View\View;

class HotelsTable extends Component
{
    use WithPagination;

    public $nom = '';

    public $selectedQuartier;

    public $orderField = 'nom';

    public $orderDirection = 'ASC';

    public array $hotelsChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nom' => 'nullable|string'
    ];

    public function updatedNom() : void
    {
        $this->resetPage();
    }

    public function deletedHotels(array $ids) : void
    {
        Hotel::destroy($ids);
        $this->hotelsChecked = [];
        session()->flash('success', 'Le(s) Hôtel(s) ont bien été supprimé');
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

        $hotels = Hotel::query();

        if(!empty($this->nom)){
            $hotels = $hotels->where('nom', 'LIKE', "%{$this->nom}%");
        }

        if($this->selectedQuartier){
            $hotels = $hotels->where('quartier_id', $this->selectedQuartier);
        }

        return view('livewire.hotels-table', [
            'hotels' => $hotels
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(20),
            'quartiers' => Quartier::orderBy('nom', 'ASC')->get()
        ]);
    }

}
