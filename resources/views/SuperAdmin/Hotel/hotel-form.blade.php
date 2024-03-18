@extends('SuperAdmin.layouts.template')

@section('title', $hotel->exists ? 'Éditer un Hôtel' : 'Créer un Hôtel')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $hotel->exists ? 'Éditer un Hôtel' : 'Créer un Hôtel' }}</h1>
    </div>

    <form method="POST" action="{{ route($hotel->exists ? 'super-admin.hotels.update' : 'super-admin.hotels.store', ['hotel' => $hotel->id]) }}">
        @csrf
        @method($hotel->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="" value="{!! $hotel->nom !!}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="longitude" label="Longitude" type="text" name="longitude" placeholder="Longitude"  readonly="" value="{{ $hotel->longitude }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="lattitude" label="Lattitude" type="text" name="lattitude" placeholder="Lattitude"  readonly="" value="{{ $hotel->lattitude }}" />
            </div>
        </div>

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="adresse_postale" label="Adresse Postale" type="text" name="adresse_postale" placeholder="Adresse Postale"  readonly="" value="{{ $hotel->adresse_postale }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="email" label="Email" type="text" name="email" placeholder="Email"  readonly="" value="{{ $hotel->email }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="telephone" label="Téléphone" type="text" name="telephone" placeholder="Téléphone"  readonly="" value="{{ $hotel->telephone }}" />
            </div>
        </div>

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="directeur" label="Directeur" type="text" name="directeur" placeholder="Directeur"  readonly="" value="{{ $hotel->directeur }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="photo" label="Photo" type="file" name="photo" placeholder="photo"  readonly="" value="{{ $hotel->photo }}" />
                <div class="form-group col">
                </div>
            </div>
        </div>

        @livewire('hotel-dynamic-select', [
            'hotel' => $hotel,
            'quartiers' => $quartiers,
            'communes' => $communes,
            'departements' => $departements,
            'arrondissements' => $arrondissements
        ])

        <button type="submit" class="btn btn-primary my-4">{{ $hotel->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
