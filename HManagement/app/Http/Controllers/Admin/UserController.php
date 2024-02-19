<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\UserFormRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('Admin.Users.users');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) : View
    {
        return view('Admin.Users.user-form', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, User $user) : RedirectResponse
    {
        $user->update($request->validated());
        return
            redirect()
            ->route('admin.users.index')
            ->with('success', 'L\'Utilisateur a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return
            redirect()
            ->route('admin.users.index')
            ->with('success', 'L\'Utilisateur a été supprimé avec succès.');
    }
}
