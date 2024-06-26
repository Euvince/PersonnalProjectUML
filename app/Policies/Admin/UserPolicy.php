<?php

namespace App\Policies\Admin;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Gérer les Utilisateurs');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->can('Gérer les Utilisateurs')
            && $model->hotel_id === Auth::user()->hotel_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Gérer les Utilisateurs');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->can('Gérer les Utilisateurs')
            && $model->hotel_id === Auth::user()->hotel_id
            && !$model->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->can('Gérer les Utilisateurs')
            && $model->hotel_id === Auth::user()->hotel_id
            && !$model->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->can('Gérer les Utilisateurs')
            && $model->hotel_id === Auth::user()->hotel_id
            && !$model->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->can('Gérer les Utilisateurs')
            && $model->hotel_id === Auth::user()->hotel_id
            && !$model->hasRole('Super Admin');
    }

    public function showClient(User $user, User $model): bool
    {
        return $user->can('Gérer les Utilisateurs')
            && $model->hasRole('Client')
            && $model->hotel_id === NULL;
    }

    public function recruter(User $user, User $model): bool
    {
        return $user->can('Gérer les Utilisateurs')
            && $model->hasRole('Client')
            && $model->hotel_id === NULL;
    }

    public function licencier(User $user, User $model): bool
    {
        return $user->can('Gérer les Utilisateurs')
            && $model->hotel_id === Auth::user()->hotel_id
            && $model->hotel_id !== NULL;
    }


    public function sendReservation(User $user): bool
    {
        return $user->can('Réserver une chambre');
    }

    public function downloadFacture(User $user): bool
    {

    }

    public function sendDemandeService(User $user): bool
    {
        return $user->can('Demander un service');
    }


    public function showProfile(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    public function editProfile(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    public function updateProfile(User $user, User $model) : bool
    {
        return $user->id === $model->id;
    }

}
