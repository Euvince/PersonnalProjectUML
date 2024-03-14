<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\Reservation;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class ClientDemandesServicesTable extends Component
{
    use WithPagination;

    public Reservation $reservation;

    public $prix = '';

    public $description = '';

    public $typeservice = '';

    public array $servicesChecked = [];

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'prix' => 'nullable|integer',
        'description' => 'nullable|string',
        'typeService' => 'nullable|string',
    ];

    public function updatedPrix() : void
    {
        $this->resetPage();
    }

    public function updatedTypeservice() : void
    {
        $this->resetPage();
    }

    public function updatedDescription() : void
    {
        $this->resetPage();
    }

    public function deletedServices(array $ids) : void
    {
        Service::destroy($ids);
        $this->servicesChecked = [];
        session()->flash('success', 'La/Les Demande(s) de service(s) a/ont bien été annulée(s)');
    }

    public function render() : View
    {
        /* $services = Service::query()
            ->where('chambre_id', $this->reservation->chambre_id)
            ->where('email_client',$this->reservation->email_client)
        ->get(); */

        $services = Service::query();
        $services = $services->whereHas('chambre', function ($query) {
            $query->where('chambre_id', $this->reservation->chambre_id);
            $query->whereHas('reservations', function ($query) {
                $query->where('termine', 0);
                $query->where('confirme', 1);
                $query->where('email_client', $this->reservation->email_client);
            });
        });

        if (!empty($this->typeservice)) {
            $services = $services->whereHas('TypeService', function ($query) {
                $query->where('type', 'LIKE', "%{$this->typeservice}%");
            });
        }

        if (!empty($this->prix)) {
            $services = $services->whereHas('TypeService', function ($query) {
                $query->where('prix', $this->prix);
            });
        }

        if (!empty($this->description)) {
            $services = $services->where('description', 'LIKE', "%{$this->description}%");
        }

        return view('livewire.client-demandes-services-table', [
            'services' => $services
            ->paginate(20)
        ]);
    }
}
