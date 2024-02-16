@extends('SuperAdmin.layouts.template')

@section('title', $departement->exists ? 'Éditer un Département' : 'Créer un Département')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $departement->exists ? 'Éditer un Département' : 'Créer un Département' }}</h1>
    </div>

    <form method="POST" action="{{ route($departement->exists ? 'super-admin.departements.update' : 'super-admin.departements.store', ['departement' => $departement->id]) }}">
        @csrf
        @method($departement->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="" value="{{ $departement->nom }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="longitude" label="Longitude" type="text" name="longitude" placeholder="Longitude"  readonly="" value="{{ $departement->longitude }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="lattitude" label="Lattitude" type="text" name="lattitude" placeholder="Lattitude"  readonly="" value="{{ $departement->lattitude }}" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ $departement->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
