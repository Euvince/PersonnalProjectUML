@extends('SuperAdmin.layouts.template')

@section('title', $commune->exists ? 'Éditer une Commune' : 'Créer une Commune')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $commune->exists ? 'Éditer une Commune' : 'Créer une Commune' }}</h1>
    </div>

    <form method="POST" action="{{ route($commune->exists ? 'super-admin.communes.update' : 'super-admin.communes.store', ['commune' => $commune->id]) }}">
        @csrf
        @method($commune->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="" value="{{ $commune->nom }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="longitude" label="Longitude" type="text" name="longitude" placeholder="Longitude"  readonly="" value="{{ $commune->longitude }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="lattitude" label="Lattitude" type="text" name="lattitude" placeholder="Lattitude"  readonly="" value="{{ $commune->lattitude }}" />
            </div>
        </div>

        <div class="row">
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label" class3="form-control" id="departement_id" label="Département" name="departement_id" :value="$departements" elementIdOnEntite="{{ $commune->departement_id }}"/>
            </div>
            <div class="col row mx-1">
            </div>
            <div class="col row mx-1">
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ $commune->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
