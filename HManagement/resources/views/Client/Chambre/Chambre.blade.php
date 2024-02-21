@extends('Client.layouts.template')

@section('title', $chambre->libelle)

@section('content')

    <div class="universite-details">
        <h2 style="font-weight: bold;">Détails de la chambre</h2>
        <div class="row">
            <div class="col">
                <img src="{{ asset('storage/images/image.png') }}" class="card-img-top" alt="...">
            </div>
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
                {{-- <a href="{{ route('clients.chambres.reservation-form', ['chambre' => $chambre->id]) }}" class="btn btn-primary">Réserver</a> --}}
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Faire une Réservation</h1>
    </div>

    <form method="POST" action="{{ route('clients.chambres.reservation-send', ['chambre' => $chambre->id]) }}">
        @csrf
        @method('post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="readonly" value="{{ auth()->check() ? auth()->user()->nom : '' }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="prenoms" label="Prénoms" type="text" name="prenoms" placeholder="Prénoms"  readonly="readonly" value="{{ auth()->check() ? auth()->user()->prenoms : '' }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="email" label="Email" type="text" name="email" placeholder="Email"  readonly="readonly" value="{{ auth()->check() ? auth()->user()->email : '' }}" />
            </div>
        </div>

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="prix_par_nuit" label="Prix par nuit" type="text" name="prix_par_nuit" placeholder="Prix par nuit"  readonly="readonly" value="{{ $chambre->TypeChambre->prix_par_nuit }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="debut_sejour" label="Début du séjour" type="date" name="debut_sejour" placeholder="Début du séjour"  readonly="" value="" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="fin_sejour" label="Fin du séjour" type="date" name="fin_sejour" placeholder="Fin du séjour"  readonly="" value="" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">Soumettre</button>
    </form>

@endsection
