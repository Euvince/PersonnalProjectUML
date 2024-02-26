<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Role;
use App\Models\TypeRole;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\RoleFormRequest;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

     /**
     * Display a listing of the resource.
     */

    public function index(): View
    {
        return view('SuperAdmin.Role.roles');
    }

     /**
      * Show the form for creating a new resource.
      */
    public function create(): View
    {
        $role = new Role();
        return view('SuperAdmin.Role.role-form', [
            'role' => $role,
            'typeroles' => TypeRole::all()->pluck('type', 'id'),
            'permissions' => Permission::where('type_role_id', TypeRole::first()->id)->get()->toArray(),
            'rolePermissions' => $role->permissions->toArray()
        ]);
    }

     /**
      * Store a newly created resource in storage.
      */
    public function store(RoleFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['permissions']);
        /* app()['cache']->forget('saptie.permission.cache'); */
        /* app()[\Saptie\Permission\PermissionRegistar::class]->forgetCachedPermissions(); */
        /* foreach ($request->permissions as $permission) {
            $permission = (int)$permission;
        } */
        Role::create($data)
            ->givePermissionTo($request->permissions);
        return
            redirect()
            ->route('super-admin.roles.index')
            ->with('success', 'Le Rôle a bien été crée');
    }

     /**
      * Show the form for editing the specified resource.
      */
    public function edit(Role $role): View | RedirectResponse
    {
        return view('SuperAdmin.Role.role-form', [
            'role' => $role,
            'typeroles' => TypeRole::all()->pluck('type', 'id'),
            'permissions' => $role->typerole->permissions->toArray(),
            'rolePermissions' => $role->permissions->toArray()
        ]);
    }

     /**
      * Update the specified resource in storage.
      */
     public function update(RoleFormRequest $request, Role $role): RedirectResponse
     {
         $data = $request->validated();
         unset($data['permissions']);
         $role->update($data);
         $role->syncPermissions($request->permissions);
         return
            redirect()
            ->route('super-admin.roles.index')
            ->with('success', 'Le Rôle a bien été modifié');
     }

     /**
      * Remove the specified resource from storage.
      */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return
            redirect()
            ->route('super-admin.roles.index')
            ->with('success', 'Le Rôle a bien été supprimé');
    }
}
