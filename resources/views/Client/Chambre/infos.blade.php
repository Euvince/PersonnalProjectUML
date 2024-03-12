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
                <p><strong>Occupé : </strong> {{ $chambre->occupe ? 'Oui' : 'Non' }}</p>
                <p><strong>Réservé : </strong> {{ $chambre->reserve ? 'Oui' : 'Non' }}</p>
                <p><strong>Prix par nuit:</strong> {{ $chambre->TypeChambre->prix_par_nuit }}$</p>
                <p>
                    <strong>Description : <br></strong>
                    {{ $chambre->description }}
                </p>
                <a style="text-decoration: none;" href="{{ route('clients.chambres-infos-download', ['chambre' => $chambre->id]) }}">Télécharger</a>
            </div>
            <div class="col">
                @if ($reservations->count() > 0)
                    <strong>Les réservations de la chambre </strong> : <br>
                    @foreach ($reservations as $k => $reservation)
                        <strong> -Réservation {{ $k + 1 }} : </strong> Du {{ $reservation->debut_sejour->translatedFormat('d F Y') }} au {{ $reservation->fin_sejour->translatedFormat('d F Y') }}
                        @if (!$loop->last)
                            , <br>
                        @endif
                    @endforeach
                @else <strong>Aucune réservation n'existe sur cette chambre</strong>
                @endif
            </div>
        </div>
    </div>

@endsection
