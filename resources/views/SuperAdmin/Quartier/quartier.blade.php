@extends('SuperAdmin.layouts.template')

@section('title', 'Un Quartier spécifique')
@section('content-title', 'Détails d\'un Quartier')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $quartier->nom }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Département : </strong> {{ $quartier->arrondissement->commune->departement->nom }}</p>
                        <p><strong>Commune : </strong> {{ $quartier->arrondissement->commune->nom }}</p>
                        <p><strong>Arrondissement : </strong> {{ $quartier->arrondissement->nom }}</p>
                        <p><strong>Nom : </strong> {{ $quartier->nom }}</p>
                        <p><strong>Longitude : </strong> {{ $quartier->longitude }}°C</p>
                    </div>
                    <div class="col">
                        <p><strong>Lattitude : </strong> {{ $quartier->lattitude }}°C</p>
                        <p><strong>Crée le : </strong> {{ $quartier->created_at->format('d-m-Y') }} à {{ $quartier->created_at->format('H:i:s') }}</p>
                        <p><strong>Crée par : </strong> {{ $quartier->created_by != NULL ? $quartier->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $quartier->updated_at->format('d-m-Y') }} à {{ $quartier->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $quartier->updated_by != NULL ? $quartier->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
