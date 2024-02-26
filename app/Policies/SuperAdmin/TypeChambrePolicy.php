<?php

namespace App\Policies\SuperAdmin;

use App\Models\TypeChambre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TypeChambrePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('Gérer les Types de Chambres');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TypeChambre $typeChambre): bool
    {
        return $user->can('Gérer les Types de Chambres');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('Gérer les Types de Chambres');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TypeChambre $typeChambre): bool
    {
        return $user->can('Gérer les Types de Chambres');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TypeChambre $typeChambre): bool
    {
        return $user->can('Gérer les Types de Chambres');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TypeChambre $typeChambre): bool
    {
        return $user->can('Gérer les Types de Chambres');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TypeChambre $typeChambre): bool
    {
        return $user->can('Gérer les Types de Chambres');
    }
}
