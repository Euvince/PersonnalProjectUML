@extends('SuperAdmin.layouts.template')

@section('title', $chambre->exists ? 'Éditer une Chambre' : 'Créer une Chambre')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $chambre->exists ? 'Éditer une Chambre' : 'Créer une Chambre' }}</h1>
    </div>

    <form method="POST" action="{{ route($chambre->exists ? 'admin.chambres.update' : 'admin.chambres.store', ['chambre' => $chambre->id]) }}" enctype="multipart/form-data">
        @csrf
        @method($chambre->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="numero" label="Numéro" type="text" name="numero" placeholder="Numéro"  readonly="" value="{{ $chambre->numero }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="libelle" label="Libellé" type="text" name="libelle" placeholder="Libellé"  readonly="" value="{{ $chambre->libelle }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="capacite" label="Capacité" type="text" name="capacite" placeholder="Capacité"  readonly="" value="{{ $chambre->capacite }}" />
            </div>
        </div>

        <div class="row">
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label mt-4" class3="form-control" id="type_chambre_id" label="Type de chambre" name="type_chambre_id" :value="$typesChambres" elementIdOnEntite="{{ $chambre->type_chambre_id }}"/>
            </div>
            <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="etage" label="Étage" type="text" name="etage" placeholder="Étage"  readonly="" value="{{ $chambre->etage }}" />
            <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="photo" label="Photo" type="file" name="photo" placeholder="Photo"  readonly="" value="{{ $chambre->photo }}" />
        </div>

        <div class="row">
            <div class="col row mx-1">
                <div class="w-100">
                    <label for="description" class="form-label mt-4">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $chambre->description }}</textarea>
                    @error('description')
                        <span style="color: red; font-size: 0.7rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ $chambre->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
