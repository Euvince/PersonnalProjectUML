<?php

namespace App\Policies\SuperAdmin;

use App\Models\Quartier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class QuartierPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Gérer les Quartiers');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Quartier $quartier): bool
    {
        return $user->can('Gérer les Quartiers');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Gérer les Quartiers');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Quartier $quartier): bool
    {
        return $user->can('Gérer les Quartiers');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Quartier $quartier): bool
    {
        return $user->can('Gérer les Quartiers');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Quartier $quartier): bool
    {
        return $user->can('Gérer les Quartiers');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Quartier $quartier): bool
    {
        return $user->can('Gérer les Quartiers');
    }
}
