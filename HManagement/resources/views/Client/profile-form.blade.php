@extends('Client.layouts.template')

@section('title', 'Éditer Profile')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Éditer votre Profile</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success mt-2" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ route('client-profile.update', ['user' => auth()->user()->id]) }}">
        @csrf
        @method('put')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="" value="{{ $user->nom }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="prenoms" label="Prénoms" type="text" name="prenoms" placeholder="Prénoms"  readonly="" value="{{ $user->prenoms }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="email" label="Email" type="text" name="email" placeholder="Email"  readonly="" value="{{ $user->email }}" />
            </div>
        </div>

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nationnalite" label="Nationnalité" type="text" name="nationnalite" placeholder="Nationnalité"  readonly="" value="{{ $user->nationnalite }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="date_naissance" label="Date de Naissance" type="text" name="date_naissance" placeholder="Date de Naissance"  readonly="" value="{{ $user->date_naissance }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="telephone" label="Téléphone" type="text" name="telephone" placeholder="Téléphone"  readonly="" value="{{ $user->telephone }}" />
            </div>
        </div>

        <div class="row">
            <div class="col row">
                <div class="form-group col">
                    <label for="sexe" class="form-label mt-4">Sexe</label>
                    <select class="form-control" name="sexe" style="height: 43px;">
                        <option value="Masculin" @selected(old('sexe', $user->sexe) == 'Masculin')>Masculin</option>
                        <option value="Féminin" @selected(old('sexe', $user->sexe) == 'Féminin')>Féminin</option>
                        <option value="Autre" @selected(old('sexe', $user->sexe) == 'Autre')>Autre</option>
                    </select>
                    @error('sexe')
                        <span style="color: red; font-size: 0.7rem">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="password" label="Mot de passe" type="password" name="password" placeholder="Mot de passe"  readonly="" value="" />
            <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="password_confirmation" label="Confirmer mot de passe" type="password" name="password_confirmation" placeholder="Mot de passe"  readonly="" value="" />
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ 'Sauvegarder' }}</button>
    </form>

@endsection
