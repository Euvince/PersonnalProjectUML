@extends('SuperAdmin.layouts.template')

@section('title', 'Un Hôtel spécifique')
@section('content-title', 'Détails d\'un Hôtel')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $hotel->nom }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Département : </strong> {{ $hotel->quartier->arrondissement->commune->departement->nom }}</p>
                        <p><strong>Commune : </strong> {{ $hotel->quartier->arrondissement->commune->nom }}</p>
                        <p><strong>Arrondissement : </strong> {{ $hotel->quartier->arrondissement->nom }}</p>
                        <p><strong>Quartier : </strong> {{ $hotel->quartier->nom }}</p>
                        <p><strong>Nom : </strong> {{ $hotel->nom }}</p>
                        <p><strong>Longitude : </strong> {{ $hotel->longitude }}°C</p>
                    </div>
                    <div class="col">
                        <p><strong>Lattitude : </strong> {{ $hotel->lattitude }}°C</p>
                        <p><strong>Crée le : </strong> {{ $hotel->created_at->format('d-m-Y') }} à {{ $hotel->created_at->format('H:i:s') }}</p>
                        <p><strong>Crée par : </strong> {{ $hotel->created_by != NULL ? $hotel->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $hotel->updated_at->format('d-m-Y') }} à {{ $hotel->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $hotel->updated_by != NULL ? $hotel->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
