<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{-- https://bootswatch.com/5/lumen/bootstrap.min.css --}}">
    <link rel="stylesheet" href="{{ asset('lumen.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="">
    <title>Système Hôteliers</title>

    <style>
        .universite-details {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .universite-details h2 {
            color: #333333;
            margin-bottom: 20px;
            /* border-bottom: 2px solid #158cba; */
            padding-bottom: 10px;
        }
        .universite-details p {
            margin-bottom: 10px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <div class="universite-details">
            <h2 style="font-weight: bold;">Facture de Réservation</h2>
            <div class="row">
                <div class="col">
                    <p><strong>Nom du client : </strong> {{ $facture->paiement->user->nom }}</p>
                    <p><strong>Prénoms du client : </strong> {{ $facture->paiement->user->prenoms }}</p>
                    <p><strong>Email du client : </strong> {{ $facture->paiement->user->email }}</p>
                    <p><strong>Téléphone du client : </strong> {{ $facture->paiement->user->telephone }}</p>
                    <p><strong>Nationnalité du client : </strong> {{ $facture->paiement->user->nationnalite }}</p>
                </div>
                <div class="col">
                    <p><strong>Type : </strong> {{ $chambre->TypeChambre->type }}</p>
                    <p><strong>Numéro : </strong> {{ $chambre->numero }}</p>
                    <p><strong>Libellé : </strong> {{ $chambre->libelle }}</p>
                    <p><strong>Montant payé:</strong> {{ $facture->montant_total }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
