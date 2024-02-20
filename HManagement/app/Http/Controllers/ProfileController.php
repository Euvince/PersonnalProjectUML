<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileFormRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function edit(User $user) : View | RedirectResponse
    {
        $this->authorize('editProfile', $user);
        return Auth::user()->hasRole('Client')
            ?  view('Client.profile-form', ['user' => $user])
            :  view('personnal-profile-form', ['user' => $user]);
    }

    public function update(ProfileFormRequest $request, User $user) : RedirectResponse
    {
        /* $this->authorize('updateProfile', $user); */
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return  Auth::user()->hasRole('Client')
               ? redirect()
                 ->route('client-profile.edit', ['user' => $user])
                 ->with('success', 'Votre profile a été modifié avec succès.')
               : redirect()
                 ->route('personnal-profile.edit', ['user' => $user])
                 ->with('success', 'Votre profile a été modifié avec succès.');
    }

}
