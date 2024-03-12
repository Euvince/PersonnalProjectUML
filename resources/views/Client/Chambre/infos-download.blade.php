<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{-- https://bootswatch.com/5/lumen/bootstrap.min.css --}}">
    <link rel="stylesheet" href="{{ asset('lumen.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="">
    <title>Infos de {{ $chambre->numero }}</title>
</head>
<body>
    <div class="container my-4">
        <div class="universite-details">
            <h2 style="font-weight: bold;">Informations sur la chambre</h2>
            <div class="row">
                <div class="col">
                    <p><strong>Type : </strong> {{ $chambre->hotel->nom }}</p>
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
        </div>
    </div>
</body>
</html>
