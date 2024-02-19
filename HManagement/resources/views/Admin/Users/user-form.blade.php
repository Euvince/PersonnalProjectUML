@extends('SuperAdmin.layouts.template')

@section('title', 'Éditer un utilisateur')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Éditer un utilisateur</h1>
    </div>

    <form method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}">
        @csrf
        @method('put')

        {{-- <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="" value="{{ $departement->nom }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="longitude" label="Longitude" type="text" name="longitude" placeholder="Longitude"  readonly="" value="{{ $departement->longitude }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="lattitude" label="Lattitude" type="text" name="lattitude" placeholder="Lattitude"  readonly="" value="{{ $departement->lattitude }}" />
            </div>
        </div> --}}

        <button type="submit" class="btn btn-primary my-4">Modifier</button>
    </form>

@endsection
