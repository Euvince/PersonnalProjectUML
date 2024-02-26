@extends('SuperAdmin.layouts.template')

@section('title', $moyenPaiement->exists ? 'Éditer un Moyen de Paiement' : 'Créer un Moyen de Paiement')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $moyenPaiement->exists ? 'Éditer un Moyen de Paiement' : 'Créer un Moyen de Paiement' }}</h1>
    </div>

    <form method="POST" action="{{ route($moyenPaiement->exists ? 'super-admin.moyen-paiement.update' : 'super-admin.moyen-paiement.store', ['moyen_paiement' => $moyenPaiement->id]) }}">
        @csrf
        @method($moyenPaiement->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="moyen" label="Moyen de Paiement" type="text" name="moyen" placeholder="Moyen de Paiement"  readonly="" value="{{ $moyenPaiement->moyen }}" />
                <div class="col row mx-1">
                </div>
                <div class="col row mx-1">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ $moyenPaiement->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
