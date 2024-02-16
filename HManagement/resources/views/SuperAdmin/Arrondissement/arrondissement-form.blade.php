@extends('SuperAdmin.layouts.template')

@section('title', $arrondissement->exists ? 'Éditer un Arrondissement' : 'Créer un Arrondissement')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $arrondissement->exists ? 'Éditer un Arrondissement' : 'Créer un Arrondissement' }}</h1>
    </div>

    <form method="POST" action="{{ route($arrondissement->exists ? 'super-admin.arrondissements.update' : 'super-admin.arrondissements.store', ['arrondissement' => $arrondissement->id]) }}">
        @csrf
        @method($arrondissement->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="" value="{{ $arrondissement->nom }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="longitude" label="Longitude" type="text" name="longitude" placeholder="Longitude"  readonly="" value="{{ $arrondissement->longitude }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="lattitude" label="Lattitude" type="text" name="lattitude" placeholder="Lattitude"  readonly="" value="{{ $arrondissement->lattitude }}" />
            </div>
        </div>

        <div class="row">
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label" class3="form-control" id="departement_id" label="Département" name="departement_id" :value="$departements" elementIdOnEntite=""/>
            </div>
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label" class3="form-control" id="commune_id" label="Commune" name="commune_id" :value="$communes" elementIdOnEntite="{{ $arrondissement->commune_id }}"/>
            </div>
            <div class="col row mx-1">
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ $arrondissement->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
