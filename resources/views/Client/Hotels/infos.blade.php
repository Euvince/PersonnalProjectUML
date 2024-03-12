@extends('Client.layouts.template')

@section('title', $hotel->nom)

@section('content')

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
                <a style="text-decoration: none;" href="{{ route('clients.hotels-infos-download', ['hotel' => $hotel->id]) }}">Télécharger</a>
            </div>
        </div>
    </div>

@endsection
