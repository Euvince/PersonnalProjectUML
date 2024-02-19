<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileFormRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(User $user) : View
    {
        return view('profile-form', ['user' => $user]);
    }

    public function update(ProfileFormRequest $request, User $user) : RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return
            redirect()
            ->route('profile.edit', ['user' => $user])
            ->with('success', 'Votre profile a été modifié avec succès.');
    }

}
