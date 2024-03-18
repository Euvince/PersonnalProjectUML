@extends('SuperAdmin.layouts.template')

@section('title', $role->exists ? 'Éditer une Rôle' : 'Créer une Rôle')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $role->exists ? 'Éditer un Rôle' : 'Créer un Rôle' }}</h1>
    </div>

    <div class="row mx-2 mt-2 mb-2">
        <p><strong>Les permissions actuelles : </strong> <br>
            @foreach ($role->permissions as $permission)
                -{{ $permission->name }}
                @if (!$loop->last)
                    , <br>
                @endif
            @endforeach
        </p>
    </div>

    <form method="POST" action="{{ route($role->exists ? 'super-admin.roles.update' : 'super-admin.roles.store', ['role' => $role->id]) }}">
        @csrf
        @method($role->exists ? 'put' : 'post')

        @livewire('role-dynamic-select', [
            'role' => $role,
            'typeroles' => $typeroles,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ])

        <button type="submit" class="btn btn-primary my-4">{{ $role->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
