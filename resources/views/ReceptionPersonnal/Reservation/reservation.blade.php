@extends('SuperAdmin.layouts.template')

@section('title', 'Une réservation spécifique')
@section('content-title', 'Détails d\'une Réservation')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">Réservation de : {{ $reservation->prenoms_client }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Chambre : </strong> {{ $reservation->chambre->numero }}</p>
                        <p><strong>Type de la chambre : </strong> {{ $reservation->chambre->TypeChambre->type }}</p>
                        <p><strong>Prix par nuit : </strong> {{ $reservation->chambre->TypeChambre->prix_par_nuit }}$</p>
                        <p><strong>Prix total : </strong> {{ $reservation->getMontant() }}$</p>
                        <p><strong>Nom du client : </strong> {{ $reservation->nom_client }}</p>
                        <p><strong>Prénoms du client : </strong> {{ $reservation->prenoms_client }}</p>
                        <p><strong>Email du client : </strong> {{ $reservation->email_client }}</p>
                        <p><strong>Téléphone du client : </strong> {{ $reservation->telephone_client }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Date de la réservation : </strong> {{ $reservation->date_reservation->translatedFormat('d F Y') }}</p>
                        <p><strong>Début du séjour : </strong> {{ $reservation->debut_sejour->translatedFormat('d F Y') }}</p>
                        <p><strong>Fin du séjour : </strong> {{ $reservation->fin_sejour->translatedFormat('d F Y') }}</p>
                        <p><strong>Crée le : </strong> {{ $reservation->created_at->format('d-m-Y') }} à {{ $reservation->created_at->format('H:i:s') }}</p>
                        <p><strong>Crée par : </strong> {{ $reservation->created_by != NULL ? $reservation->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $reservation->updated_at->format('d-m-Y') }} à {{ $reservation->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $reservation->updated_by != NULL ? $reservation->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
