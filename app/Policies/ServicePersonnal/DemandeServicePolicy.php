<?php

namespace App\Policies\ServicePersonnal;

use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DemandeServicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Gérer les Demandes de Services');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Service $service): bool
    {
        return $user->can('Gérer les Demandes de Services');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Gérer les Demandes de Services');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $service): bool
    {
        return $user->can('Gérer les Demandes de Services')
            && !$service->isRendered()
            && $service->chambre->isOccupied();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $service): bool
    {
        return $user->can('Gérer les Demandes de Services')
            && !$service->isRendered()
            && $service->chambre->isOccupied();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Service $service): bool
    {
        return $user->can('Gérer les Demandes de Services');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Service $service): bool
    {
        return $user->can('Gérer les Demandes de Services')
            && !$service->isRendered()
            && $service->chambre->isOccupied();
    }

    public function confirmDemandeService(User $user, Service $service): bool
    {
        return $user->can('Gérer les Demandes de Services')
            && !$service->isRendered()
            && $service->chambre->isOccupied();
    }

    public function cannotRenderedService(User $user, Service $service): bool
    {
        return $user->can('Gérer les Demandes de Services')
            && !$service->isRendered()
            && $service->chambre->isOccupied();
    }
}
