@extends('SuperAdmin.layouts.template')

@section('title', 'Un Arrondissement spécifique')
@section('content-title', 'Détails d\'un Arrondissement')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $arrondissement->nom }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Département : </strong> {{ $arrondissement->commune->departement->nom }}</p>
                        <p><strong>Commune : </strong> {{ $arrondissement->commune->nom }}</p>
                        <p><strong>Nom : </strong> {{ $arrondissement->nom }}</p>
                        <p><strong>Longitude : </strong> {{ $arrondissement->longitude }}°C</p>
                        <p><strong>Lattitude : </strong> {{ $arrondissement->lattitude }}°C</p>
                    </div>
                    <div class="col">
                        <p><strong>Crée le : </strong> {{ $arrondissement->created_at->format('d-m-Y') }} à {{ $arrondissement->created_at->format('H:i:s') }}</p>
                        <p><strong>Crée par : </strong> {{ $arrondissement->created_by != NULL ? $arrondissement->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $arrondissement->updated_at->format('d-m-Y') }} à {{ $arrondissement->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $arrondissement->updated_by != NULL ? $arrondissement->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
