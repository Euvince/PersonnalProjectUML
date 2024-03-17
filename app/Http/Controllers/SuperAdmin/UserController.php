<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\UserFormRequest;
use App\Models\Hotel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {

        return view('SuperAdmin.Users.users');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) : View
    {
        return view('SuperAdmin.Users.user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) : View
    {
        return view('SuperAdmin.Users.user-form', [
            'user' => $user,
            'roles' => Role::all()->pluck('name', 'id'),
            'hotels' => Hotel::all()->pluck('nom', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, User $user) : RedirectResponse
    {
        $user->update(['hotel_id' => $request->hotel_id]);
        $user->roles()->sync($request['roles']);
        foreach ($user->permissions as $permission) {
            $user->revokePermissionTo($permission);
        }
        foreach($request['roles'] as $role){
            foreach (Role::find($role)->permissions as $permission) {
                $user->givePermissionTo($permission->name);
            }
        }
        /* foreach($request['roles'] as $role){
            $user->permissions()->sync(Role::findById($role)->permissions);
        } */
        return
            redirect()
            ->route('super-admin.users.index')
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
            ->route('super-admin.users.index')
            ->with('success', 'L\'Utilisateur a été supprimé avec succès.');
    }

}
