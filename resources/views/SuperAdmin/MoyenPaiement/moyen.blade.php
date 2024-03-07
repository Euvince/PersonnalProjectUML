@extends('SuperAdmin.layouts.template')

@section('title', 'Un Moyen de paiement spécifique')
@section('content-title', 'Détails d\'un Moyen de paiement')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $moyenPaiement->moyen }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Numéro : </strong> {{ $moyenPaiement->id }}</p>
                        <p><strong>Moyen : </strong> {{ $moyenPaiement->moyen }}</p>
                        <p><strong>Crée le : </strong> {{ $moyenPaiement->created_at->format('d-m-Y') }} à {{ $moyenPaiement->created_at->format('H:i:s') }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Crée par : </strong> {{ $moyenPaiement->created_by != NULL ? $moyenPaiement->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $moyenPaiement->updated_at->format('d-m-Y') }} à {{ $moyenPaiement->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $moyenPaiement->updated_by != NULL ? $moyenPaiement->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
