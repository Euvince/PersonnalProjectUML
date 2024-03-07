@extends('SuperAdmin.layouts.template')

@section('title', 'Les départements')
@section('content-title', 'Détails d\'un Département')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $departement->nom }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Numéro : </strong> {{ $departement->id }}</p>
                        <p><strong>Nom : </strong> {{ $departement->nom }}</p>
                        <p><strong>Longitude : </strong> {{ $departement->longitude }}°C</p>
                        <p><strong>Lattitude : </strong> {{ $departement->lattitude }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Crée le : </strong> {{ $departement->created_at->format('d-m-Y') }} à {{ $departement->created_at->format('H:i:s') }}</p>
                        <p><strong>Crée par : </strong> {{ $departement->created_by != NULL ? $departement->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $departement->updated_at->format('d-m-Y') }} à {{ $departement->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $departement->updated_by != NULL ? $departement->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
