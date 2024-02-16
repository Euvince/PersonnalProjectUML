@extends('SuperAdmin.layouts.template')

@section('title', $quartier->exists ? 'Éditer un Quartier' : 'Créer un Quartier')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $quartier->exists ? 'Éditer un Quartier' : 'Créer un Quartier' }}</h1>
    </div>

    <form method="POST" action="{{ route($quartier->exists ? 'super-admin.quartiers.update' : 'super-admin.quartiers.store', ['quartier' => $quartier->id]) }}">
        @csrf
        @method($quartier->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="" value="{{ $quartier->nom }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="longitude" label="Longitude" type="text" name="longitude" placeholder="Longitude"  readonly="" value="{{ $quartier->longitude }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="lattitude" label="Lattitude" type="text" name="lattitude" placeholder="Lattitude"  readonly="" value="{{ $quartier->lattitude }}" />
            </div>
        </div>

        <div class="row">
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label" class3="form-control" id="departement_id" label="Département" name="departement_id" :value="$departements" elementIdOnEntite=""/>
            </div>
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label" class3="form-control" id="commune_id" label="Commune" name="commune_id" :value="$communes" elementIdOnEntite=""/>
            </div>
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label" class3="form-control" id="arrondissement_id" label="Arrondissement" name="arrondissement_id" :value="$arrondissements" elementIdOnEntite="{{ $quartier->arrondissement_id }}"/>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ $quartier->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
