@extends('SuperAdmin.layouts.template')

@section('title', 'Une chambre spécifique')
@section('content-title', 'Détails d\'une Chambre')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $chambre->libelle }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Numéro : </strong> {{ $chambre->numero }}</p>
                        <p><strong>Libellé : </strong> {{ $chambre->libelle }}</p>
                        <p><strong>Étage : </strong> {{ $chambre->etage }}</p>
                        <p><strong>Description : </strong> {{ $chambre->description }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Statut : </strong> {{ $chambre->statut }}</p>
                        <p><strong>Type de chambre : </strong> {{ $chambre->TypeChambre->type }}</p>
                        <p><strong>Crée le : </strong> {{ $chambre->created_at->format('d-m-Y') }} à {{ $chambre->created_at->format('H:i:s') }}</p>
                        <p><strong>Crée par : </strong> {{ $chambre->created_by != NULL ? $chambre->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $chambre->updated_at->format('d-m-Y') }} à {{ $chambre->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $chambre->updated_by != NULL ? $chambre->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
