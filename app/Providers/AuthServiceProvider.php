<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Hotel;
use App\Models\Commune;
use App\Models\Quartier;
use App\Models\Departement;
use App\Models\TypeChambre;
use App\Models\TypeService;
use App\Models\Arrondissement;
use App\Models\Chambre;
use App\Models\MoyenPaiement;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use App\Policies\Admin\ChambrePolicy;
use App\Policies\SuperAdmin\HotelPolicy;
use App\Policies\SuperAdmin\CommunePolicy;
use App\Policies\SuperAdmin\QuartierPolicy;
use App\Policies\SuperAdmin\DepartementPolicy;
use App\Policies\SuperAdmin\TypeChambrePolicy;
use App\Policies\SuperAdmin\TypeServicePolicy;
use App\Policies\SuperAdmin\ArrondissementPolicy;
use App\Policies\SuperAdmin\MoyenPaiementPolicy;
use App\Policies\SuperAdmin\RolePolicy;
use App\Policies\Admin\UserPolicy;
use App\Policies\ReceptionPersonnal\ReservationPolicy;
use App\Policies\ServicePersonnal\DemandeServicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Hotel::class => HotelPolicy::class,
        Chambre::class => ChambrePolicy::class,
        Commune::class => CommunePolicy::class,
        Quartier::class => QuartierPolicy::class,
        TypeChambre::class => TypeChambrePolicy::class,
        TypeService::class => TypeServicePolicy::class,
        Departement::class => DepartementPolicy::class,
        Service::class => DemandeServicePolicy::class,
        Reservation::class => ReservationPolicy::class,
        MoyenPaiement::class => MoyenPaiementPolicy::class,
        Arrondissement::class => ArrondissementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
