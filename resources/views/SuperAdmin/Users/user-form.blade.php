@extends('SuperAdmin.layouts.template')

@section('title', 'Éditer un utilisateur')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Éditer un utilisateur</h1>
    </div>

    <div class="row mx-2">
        <p><strong>Les rôles actuels : </strong> <br>
            @foreach ($user->roles as $role)
                -{{ $role->name }}
                @if (!$loop->last)
                    , <br>
                @endif
            @endforeach
        </p>
    </div>

    <form method="POST" action="{{ route('super-admin.users.update', ['user' => $user->id]) }}">
        @csrf
        @method('put')

        {{-- @livewire('super-admin-user-dynamic-select', [
            'user' => $user,
            'quartiers' => $quartiers,
            'communes' => $communes,
            'departements' => $departements,
            'arrondissements' => $arrondissements
        ]) --}}


        <div class="row">
            <div class="col row mx-1">
                <x-select class1="form-group w-50" class2="col-form-label" class3="form-control" id="hotel_id" label="Hôtel" name="hotel_id" :value="$hotels" elementIdOnEntite="{{ $user->hotel_id }}"/>
            </div>
        </div>

        <div class="row">
            <div class="col row">
                <div class="form-group w-50 mx-3 mt-4">
                    <label for="roles" class="col-form-label">Rôles</label>
                    <select class="form-control" style="height: 200px;" placeholder="Choisissez quelques roles" id="roles" name="roles[]" multiple="multiple">
                        @foreach ($roles as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('roles')
                        <span style="color: red; font-size: 0.7rem">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-2">Modifier</button>
    </form>

@endsection
