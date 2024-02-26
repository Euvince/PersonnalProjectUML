@extends('Client.layouts.template')

@section('title', 'Réservation')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Faire une Réservation</h1>
    </div>

    <form method="POST" action="">
        @csrf
        @method('post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="" value="" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="longitude" label="Longitude" type="text" name="longitude" placeholder="Longitude"  readonly="" value="" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="lattitude" label="Lattitude" type="text" name="lattitude" placeholder="Lattitude"  readonly="" value="" />
            </div>
        </div>

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="adresse_postale" label="Adresse Postale" type="text" name="adresse_postale" placeholder="Adresse Postale"  readonly="" value="" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="email" label="Email" type="text" name="email" placeholder="Email"  readonly="" value="" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="telephone" label="Téléphone" type="text" name="telephone" placeholder="Téléphone"  readonly="" value="" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">Soumettre</button>
    </form>

@endsection
