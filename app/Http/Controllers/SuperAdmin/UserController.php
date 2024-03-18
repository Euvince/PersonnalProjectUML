<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Role;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Quartier;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\UserFormRequest;

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
    public function edit(User $user) : View | RedirectResponse
    {
        $departements = Departement::has('communes', '>=', 1)->orderBy('nom', 'ASC')->get();
        if ($departements->isEmpty()) {
            return redirect()
            ->route('super-admin.users.index')
            ->with('error', 'Veuillez disposer d\'un Département contenant au moins une commune d\'abord.');
        }

        $communes = $departements->first()->communes->sortBy('nom');
        if ($communes->isEmpty()) {
            return redirect()
            ->route('super-admin.users.index')
            ->with('error', 'Veuillez disposer d\'une Commune contenant au moins un arrondissement d\'abord.');
        }

        $arrondissements = $communes->first()->arrondissements->sortBy('nom');
        if ($communes->isEmpty()) {
            return redirect()
            ->route('super-admin.users.index')
            ->with('error', 'Veuillez disposer d\'une Commune contenant au moins un arrondissement d\'abord.');
        }

        $quartiers = $arrondissements->first()->quartiers->sortBy('nom');
        if ($arrondissements->isEmpty()) {
            return redirect()
            ->route('super-admin.users.index')
            ->with('error', 'Vos communes doivent disposer d\'arrondissement(s) et ceux-ci de quartier(s).');
        }

        if ($quartiers->isEmpty()) {
            return redirect()
            ->route('super-admin.users.index')
            ->with('error', 'Vos arrondissements doivent disposer de quartier(s) et ceux-ci d\'hôtel(s).');
        }

        return view('SuperAdmin.Users.user-form', [
            'user' => $user,
            'roles' => Role::where('name', '!=', 'Client')->pluck('name', 'id'),
            'departements' => $departements,
            'communes' => $communes,
            'arrondissements' => $arrondissements,
            'quartiers' => $quartiers,
            'hotels' => $quartiers->first()->hotels->sortBy('nom'),
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
    public function destroy(User $user) : RedirectResponse
    {
        $user->delete();
        return
            redirect()
            ->route('super-admin.users.index')
            ->with('success', 'L\'Utilisateur a été supprimé avec succès.');
    }

    public function licencier(User $user) : RedirectResponse
    {
        $user->update(['hotel_id' => NULL]);
        $user->roles()->sync(['Client']);
        $user->syncPermissions(['Réserver une Chambre', 'Demander un Service']);
        return
            redirect()
            ->route('super-admin.users.index')
            ->with('success', 'L\'Utilisateur est devenu simplement client avec succès.');
    }

}
