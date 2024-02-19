<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    /* public function edit(User $user): bool
    {
        return $user->id === Auth::user()->id;
    } */

}
