@extends('SuperAdmin.layouts.template')

@section('title', 'Une Commune spécifique')
@section('content-title', 'Détails d\'une Commune')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $commune->nom }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Département : </strong> {{ $commune->departement->nom }}</p>
                        <p><strong>Nom : </strong> {{ $commune->nom }}</p>
                        <p><strong>Longitude : </strong> {{ $commune->longitude }}°C</p>
                        <p><strong>Lattitude : </strong> {{ $commune->lattitude }}°C</p>
                    </div>
                    <div class="col">
                        <p><strong>Crée le : </strong> {{ $commune->created_at->format('d-m-Y') }} à {{ $commune->created_at->format('H:i:s') }}</p>
                        <p><strong>Crée par : </strong> {{ $commune->created_by != NULL ? $commune->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $commune->updated_at->format('d-m-Y') }} à {{ $commune->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $commune->updated_by != NULL ? $commune->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
