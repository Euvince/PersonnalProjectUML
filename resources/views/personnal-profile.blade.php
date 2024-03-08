@extends('SuperAdmin.layouts.template')

@section('title', 'Consulter Profile')
@section('content-title', 'Consulter mon profile')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $user->nom }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Nom : </strong> {{ $user->nom }}</p>
                        <p><strong>Prénoms : </strong> {{ Str::ucfirst($user->prenoms) }}</p>
                        <p><strong>Email : </strong> {{ $user->email }}</p>
                        <p><strong>Téléphone : </strong> {{ $user->telephone }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Sexe : </strong> {{ $user->sexe }}</p>
                        <p><strong>Date de naissance : </strong> {{ $user->date_naissance->format('d-m-Y') }}</p>
                        <p><strong>Nationnalité : </strong> {{ $user->nationnalite }}</p>
                        <a style="text-decoration: none;" href="{{ route('personnal-profile.edit', ['user' => auth()->user()->id]) }}">Mettre à jour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
