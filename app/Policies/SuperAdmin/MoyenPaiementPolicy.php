<?php

namespace App\Policies\SuperAdmin;

use App\Models\MoyenPaiement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MoyenPaiementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Gérer les Moyens de Paiement');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MoyenPaiement $moyenPaiement): bool
    {
        return $user->can('Gérer les Moyens de Paiement');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Gérer les Moyens de Paiement');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MoyenPaiement $moyenPaiement): bool
    {
        return $user->can('Gérer les Moyens de Paiement');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MoyenPaiement $moyenPaiement): bool
    {
        return $user->can('Gérer les Moyens de Paiement');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MoyenPaiement $moyenPaiement): bool
    {
        return $user->can('Gérer les Moyens de Paiement');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MoyenPaiement $moyenPaiement): bool
    {
        return $user->can('Gérer les Moyens de Paiement');
    }
}
