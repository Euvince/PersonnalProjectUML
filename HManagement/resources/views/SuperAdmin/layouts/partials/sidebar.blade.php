@php
    $routeName = request()->route()->getName();
@endphp

<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                @can('Gérer les Départements')
                    <li @class(['active' => str_contains($routeName, 'departements')])>
                        <a href="{{ route('super-admin.departements.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Départements</span></a>
                    </li>
                @endcan
                @can('Gérer les Communes')
                    <li @class(['active' => str_contains($routeName, 'communes')])>
                        <a href="{{ route('super-admin.communes.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Communes</span></a>
                    </li>
                @endcan
                @can('Gérer les Arrondissements')
                    <li @class(['active' => str_contains($routeName, 'arrondissements')])>
                        <a href="{{ route('super-admin.arrondissements.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Arrondissements</span></a>
                    </li>
                @endcan
                @can('Gérer les Quartiers')
                    <li @class(['active' => str_contains($routeName, 'quartiers')])>
                        <a href="{{ route('super-admin.quartiers.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Quartiers</span></a>
                    </li>
                @endcan
                @can('Gérer les Hôtels')
                    <li @class(['active' => str_contains($routeName, 'hotels')])>
                        <a href="{{ route('super-admin.hotels.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Hôtels</span></a>
                    </li>
                @endcan
                @can('Gérer les Types de Chambres')
                    <li @class(['active' => str_contains($routeName, 'type-chambre')])>
                        <a href="{{ route('super-admin.type-chambre.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Types de Chambres</span></a>
                    </li>
                @endcan
                @can('Gérer les Types de Services')
                    <li @class(['active' => str_contains($routeName, 'type-service')])>
                        <a href="{{ route('super-admin.type-service.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Types de Services</span></a>
                    </li>
                @endcan
                @can('Gérer les Moyens de Paiement')
                    <li @class(['active' => str_contains($routeName, 'moyen-paiement')])>
                        <a href="{{ route('super-admin.moyen-paiement.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Moyens de Paiement</span></a>
                    </li>
                @endcan
                @can('Gérer les Rôles')
                    <li @class(['active' => str_contains($routeName, 'roles')])>
                        <a href="{{ route('super-admin.roles.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Rôles</span></a>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
</div>
