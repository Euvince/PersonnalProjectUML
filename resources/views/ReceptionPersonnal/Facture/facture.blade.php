@extends('SuperAdmin.layouts.template')

@section('title', 'Une facture spécifique')
@section('content-title', 'Détails d\'une Facture')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">Facture de : {{ $facture->prenoms_client }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Nom du client : </strong> {{ $facture->nom_client }}</p>
                        <p><strong>Prénoms du client : </strong> {{ $facture->prenoms_client }}</p>
                        <p><strong>Email du client : </strong> {{ $facture->email_client }}</p>
                        <p><strong>Téléphone du client : </strong> {{ $facture->telephone_client }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Chambre : </strong> {{ $facture->paiement->reservation->chambre->numero }}</p>
                        <p><strong>Numéro de chambre : </strong> {{ $facture->paiement->reservation->chambre->numero }}</p>
                        <p><strong>Montant total : </strong> {{ number_format($facture->montant_total, 0, ',', '.')}}$</p>
                        <p><strong>Montant payé : </strong> {{ number_format($facture->montant_total, 0, ',', '.')}}$</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
