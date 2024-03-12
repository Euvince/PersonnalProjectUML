<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{-- https://bootswatch.com/5/lumen/bootstrap.min.css --}}">
    <link rel="stylesheet" href="{{ asset('lumen.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="">
    <title>Infos de {{ $hotel->nom }}</title>
</head>
<body>
    <div class="container my-4">
        <div class="universite-details">
            <h2 style="font-weight: bold;">Informations sur l'hôtel</h2>
            <div class="row">
                <div class="col">
                    <p><strong>Nom : </strong> {{ $hotel->nom }}</p>
                    <p><strong>Longitude : </strong> {{ $hotel->longitude }}°</p>
                    <p><strong>Lattitude : </strong> {{ $hotel->lattitude }}°</p>
                    <p><strong>Adresse Postale : </strong> {{ $hotel->adresse_postale }}</p>
                    <p><strong>Email : </strong> {{ $hotel->email }}</p>
                    <p><strong>Téléphone : </strong> {{ $hotel->telephone }}</p>
                </div>
                <div class="col">
                    <p><strong>Directeur : </strong> {{ $hotel->directeur }}</p>
                    <p><strong>Département : </strong> {{ $hotel->departement->nom }}</p>
                    <p><strong>Commune : </strong> {{ $hotel->commune->nom }}</p>
                    <p><strong>Arrondissement : </strong> {{ $hotel->arrondissement->nom }}</p>
                    <p><strong>Quartier : </strong> {{ $hotel->quartier->nom }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
