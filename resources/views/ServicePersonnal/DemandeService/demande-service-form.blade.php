@extends('SuperAdmin.layouts.template')

@section('title', $demandeService->exists ? 'Éditer une une demande de service' : 'Créer une demande de service')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $demandeService->exists ? 'Éditer une demande de service' : 'Créer une demande de service' }}</h1>
    </div>

    @if (session('error'))
        <div class="alert alert-danger mt-2" role="alert">
            <strong>{{ session('error') }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ route($demandeService->exists ? 'service-personnal.demande-service.update' : 'service-personnal.demande-service.store', ['demande_service' => $demandeService->id]) }}">
        @csrf
        @method($demandeService->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom_client" label="Nom du client" type="text" name="nom_client" placeholder="Nom"  readonly="" value="{{ $demandeService->nom_client }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="prenoms_client" label="Prénoms du client" type="text" name="prenoms_client" placeholder="Prénoms"  readonly="" value="{{ $demandeService->prenoms_client }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="email_client" label="Email du client" type="text" name="email_client" placeholder="Email"  readonly="" value="{{ $demandeService->email_client }}" />
            </div>
        </div>

        <div class="row">
            <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="telephone_client" label="Téléphone du client" type="text" name="telephone_client" placeholder="Téléphone"  readonly="" value="{{ $demandeService->telephone_client }}" />
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label mt-4" class3="form-control" id="chambre_id" label="Chambre" name="chambre_id" :value="$chambres" elementIdOnEntite="{{ $demandeService->chambre_id }}"/>
            </div>
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label mt-4" class3="form-control" id="type_service_id" label="Type de service" name="type_service_id" :value="$typesServices" elementIdOnEntite="{{ $demandeService->chambre_id }}"/>
            </div>
        </div>

        <div class="row">
            <div class="col row mx-1">
                <label for="description" class="form-label mt-4">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $demandeService->description) }}</textarea>
                @error('description')
                    <span style="color: red; font-size: 0.7rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ $demandeService->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
