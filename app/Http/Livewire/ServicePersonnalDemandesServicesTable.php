<?php

namespace App\Http\Livewire;

use DateTime;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Jobs\CancelDemandeServiceJob;
use App\Jobs\CannotRenderedServiceJob;

class ServicePersonnalDemandesServicesTable extends Component
{
    use WithPagination;

    public $numChambre = '';

    public $userLastName = '';

    public $userFirstName = '';

    public $orderField = 'created_at';

    public $orderDirection = 'ASC';

    public array $servicesChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        /* 'numChambre' => 'nullable', */
        'userLastName' => 'nullable|string',
        'userFirstName' => 'nullable|string',
    ];

    public function updatedChambreNum() : void
    {
        $this->resetPage();
    }

    public function updatedUserLastName() : void
    {
        $this->resetPage();
    }

    public function updatedUserFirstName() : void
    {
        $this->resetPage();
    }

    public function confirmDemandes(array $ids) : void
    {
        foreach ($ids as $id) {

        }
        $this->servicesChecked = [];
        session()->flash('success', 'La/Les Réservation(s) a/ont bien été confirmée(s)');
    }

    public function cannotRanderedServices(array $ids) : void
    {
        foreach ($ids as $id) {
            $demandeService = Service::find($id);
            CannotRenderedServiceJob::dispatch($demandeService);
        }
        $this->servicesChecked = [];
        session()->flash('success', 'Le(s) clients ont bien été informé(s) que le service demandé n\'est pas dispobible.');
    }

    public function cancelDemandes(array $ids) : void
    {
        foreach ($ids as $id) {
            $service = Service::find($id);
            $service->delete();
            CancelDemandeServiceJob::dispatch($service);
        }
        $this->servicesChecked = [];
        session()->flash('success', 'Le(s) Demandes(s) de service(s) a/ont bien été annulée(s)');
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

        $services = Service::query();
        $services = $services->whereHas('chambre', function ($query) {
            $query->where('hotel_id', '=', Auth::user()->hotel_id);
        });
        if(!empty($this->numChambre)){
            $services = $services->where('chambre_id', 'LIKE', "%{$this->numChambre}%");
        }

        if(!empty($this->userLastName)){
            $services = $services->where('prenoms_client', 'LIKE', "%{$this->userLastName}%");
        }

        if(!empty($this->userFirstName)){
            $services = $services->where('nom_client', 'LIKE', "%{$this->userFirstName}%");
        }

        return view('livewire.service-personnal-demandes-services-table', [
            'services' => $services
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(15)
        ]);
    }

}
