@extends('Client.layouts.template')

@section('title', $chambre->libelle)

@section('content')

    <div class="universite-details">
        <h2 style="font-weight: bold;">Détails de la chambre</h2>
        <div class="row">
            <div class="col">
                <p><strong>Type : </strong> {{ $chambre->TypeChambre->type }}</p>
                <p><strong>Numéro : </strong> {{ $chambre->numero }}</p>
                <p><strong>Libellé : </strong> {{ $chambre->libelle }}</p>
                <p><strong>Capacité : </strong> {{ $chambre->capacite }}personnes</p>
                <p><strong>Statut : </strong> {{ $chambre->statut }}</p>
                <p><strong>Prix par nuit:</strong> {{ $chambre->TypeChambre->prix_par_nuit }}$</p>
                <p>
                    <strong>Description : <br></strong>
                    {{ Str::limit($chambre->description , 200, '...') }}
                </p>
            </div>
        </div>
    </div>

@endsection
