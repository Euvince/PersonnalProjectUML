@extends('SuperAdmin.layouts.template')

@section('title', 'Une Demande de service spécifique')
@section('content-title', 'Détails d\'une Demande de service')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">Demande de service de : {{ $demandeService->prenoms_client }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Chambre : </strong> {{ $demandeService->chambre->numero }}</p>
                        <p><strong>Type de service : </strong> {{ $demandeService->TypeService->type }}</p>
                        <p><strong>Prix : </strong> {{ $demandeService->TypeService->prix }}$</p>
                        <p><strong>Description : </strong> {{ $demandeService->description }}</p>
                        <p><strong>Nom du client : </strong> {{ $demandeService->nom_client }}</p>
                        <p><strong>Prénoms du client : </strong> {{ $demandeService->prenoms_client }}</p>
                        <p><strong>Email du client : </strong> {{ $demandeService->email_client }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Téléphone du client : </strong> {{ $demandeService->telephone_client }}</p>
                        <p><strong>Date de la demande : </strong> {{ $demandeService->date_demande_service->translatedFormat('d F Y') }}</p>
                        <p><strong>Crée le : </strong> {{ $demandeService->created_at->format('d-m-Y') }} à {{ $demandeService->created_at->format('H:i:s') }}</p>
                        <p><strong>Crée par : </strong> {{ $demandeService->created_by != NULL ? $demandeService->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $demandeService->updated_at->format('d-m-Y') }} à {{ $demandeService->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $demandeService->updated_by != NULL ? $demandeService->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
