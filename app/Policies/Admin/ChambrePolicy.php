<?php

namespace App\Policies\Admin;

use App\Models\Chambre;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ChambrePolicy
{

    /* FOR ADMINS */

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Gérer les Chambres');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Chambre $chambre): bool
    {
        return $user->can('Gérer les Chambres')
            && $chambre->hotel_id === Auth::user()->hotel_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Gérer les Chambres');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chambre $chambre): bool
    {
        return $user->can('Gérer les Chambres')
            && $chambre->hotel_id === Auth::user()->hotel_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chambre $chambre): bool
    {
        return $user->can('Gérer les Chambres')
            && $chambre->hotel_id === Auth::user()->hotel_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chambre $chambre): bool
    {
        return $user->can('Gérer les Chambres')
            && $chambre->hotel_id === Auth::user()->hotel_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chambre $chambre): bool
    {
        return $user->can('Gérer les Chambres')
            && $chambre->hotel_id === Auth::user()->hotel_id;
    }

    /* FOR RECEPTIONNISTS */

    public function index(User $user): bool
    {
        return $user->canAny(['Gérer les Réservations', 'Gérer les Demandes de Services']);
    }

    public function show(User $user, Chambre $chambre): bool
    {
        return $user->canAny(['Gérer les Réservations', 'Gérer les Demandes de Services'])
            && $chambre->hotel_id === Auth::user()->hotel_id;
    }

}
