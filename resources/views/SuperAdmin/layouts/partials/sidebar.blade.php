@php
    $routeName = request()->route()->getName();
@endphp

<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                @canAny([
                    'Gérer les Départements',
                    'Gérer les Communes',
                    'Gérer les Arrondissements',
                    'Gérer les Quartiers',
                    'Gérer les Hôtels',
                    'Gérer les Types de Chambres',
                    'Gérer les Types de Services',
                    'Gérer les Moyens de Paiement',
                    'Gérer les Rôles',
                    'Gérer les Utilisateurs',
                    'Gérer les Chambres',
                    'Gérer les Réservations',
                    'Gérer les Demandes de Services',
                ])
                    <li @class(['active' => str_contains($routeName, 'statistiques')])>
                        <a href="{{ route('statistiques') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Statistiques</span></a>
                    </li>
                    <li @class(['active' => str_contains($routeName, 'profile')])>
                        <a href="{{ route('personnal-profile.show', ['user' => auth()->user()->id]) }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Mon Profile</span></a>
                    </li>
                @endcan
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
                @can('Gérer les Utilisateurs')
                    <li @class(['active' => str_contains($routeName, 'users')])>
                        <a href="{{ route('admin.users.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Utilisateurs</span></a>
                    </li>
                @endcan
                @can('Gérer les Chambres')
                    <li @class(['active' => str_contains($routeName, 'chambres')])>
                        <a href="{{ route('admin.chambres.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Chambres</span></a>
                    </li>
                @endcan
                @can('Gérer les Réservations')
                    <li @class(['active' => str_contains($routeName, 'chambres')])>
                        <a href="{{ route('reception-personnal.chambres.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Chambres</span></a>
                    </li>
                @endcan
                @can('Gérer les Réservations')
                    <li @class(['active' => str_contains($routeName, 'reservations')])>
                        <a href="{{ route('reception-personnal.reservations.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Réservations</span></a>
                    </li>
                @endcan
                @can('Gérer les Réservations')
                    <li @class(['active' => str_contains($routeName, 'factures')])>
                        <a href="{{ route('reception-personnal.factures.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Factures</span></a>
                    </li>
                @endcan
                @can('Gérer les Demandes de Services')
                    <li @class(['active' => str_contains($routeName, 'demande-service')])>
                        <a href="" aria-expanded="true"><i class="ti-dashboard"></i><span>Demandes de services</span></a>
                    </li>
                @endcan

                @can('Gérer les Utilisateurs')
                    <li @class(['active' => str_contains($routeName, 'clients')]) style="margin-top: 15px;">
                        <a href="{{ route('admin.clients.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Tous les Clients</span></a>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
</div>
