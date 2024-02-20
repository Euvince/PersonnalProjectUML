<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        /* dd(Auth::user()->hasRole(['Client', 'Super Admin'])); */
        /* foreach (User::find(1)->roles as $role) {
            $rolesNames[] = $role->name;
        }
        dd($rolesNames); */
        /* $rolesNames = [];
        array_map(function ($role) use (&$rolesNames) {
            $rolesNames[] = $role['name'];
        }, User::find(1)->roles->toArray());
        dd($rolesNames); */
        /* dd(in_array('Super Admin', $rolesNames)); */
        /* dd(User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'Super Admin');
        })->get()); */
        return view('Admin.Users.users');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) : View
    {
        return view('Admin.Users.user-form', [
            'user' => $user,
            'roles' => Role::where('name', '!=', 'Super Admin')->pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, User $user) : RedirectResponse
    {
        $user->roles()->sync($request['roles']);
        foreach($request['roles'] as $role){
            $user->permissions()->sync(Role::find($role)->permissions);
        }
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
