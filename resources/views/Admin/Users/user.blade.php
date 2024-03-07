@extends('SuperAdmin.layouts.template')

@section('title', 'Un utilisateur spécifique')
@section('content-title', 'Détails d\'un Utilisateur')

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
                        <p><strong>Sexe : </strong> {{ $user->sexe }}</p>
                        <p><strong>Date de naissance : </strong> {{ $user->date_naissance->format('d-m-Y') }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Nationnalité : </strong> {{ $user->nationnalite }}</p>
                        <p><strong>Crée le : </strong> {{ $user->created_at->format('d-m-Y') }} à {{ $user->created_at->format('H:i:s') }}</p>
                        <p><strong>Crée par : </strong> {{ $user->created_by != NULL ? $user->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $user->updated_at->format('d-m-Y') }} à {{ $user->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $user->updated_by != NULL ? $user->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
