@extends('Client.layouts.template')

@section('title', 'Consulter Profile')

@section('content')
    <div class="universite-details">
        <h2 style="font-weight: bold;">Consulter Profile</h2>
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
                <a style="text-decoration: none;" href="{{ route('client-profile.edit', ['user' => auth()->user()->id]) }}">Mettre à jour</a>
            </div>
        </div>
    </div>

@endsection
