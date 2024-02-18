<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Commune;
use App\Models\Departement;
use App\Models\Hotel;
use App\Models\Quartier;
use App\Policies\SuperAdmin\CommunePolicy;
use App\Policies\SuperAdmin\DepartementPolicy;
use App\Policies\SuperAdmin\HotelPolicy;
use App\Policies\SuperAdmin\QuartierPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Hotel::class => HotelPolicy::class,
        Commune::class => CommunePolicy::class,
        Quartier::class => QuartierPolicy::class,
        Departement::class => DepartementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
