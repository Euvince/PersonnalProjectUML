@extends('SuperAdmin.layouts.template')

@section('title', $typeChambre->exists ? 'Éditer un Type de Chambre' : 'Créer un Type de Chambre')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $typeChambre->exists ? 'Éditer un Type de Chambre' : 'Créer un Type de Chambre' }}</h1>
    </div>

    <form method="POST" action="{{ route($typeChambre->exists ? 'super-admin.type-chambre.update' : 'super-admin.type-chambre.store', ['type_chambre' => $typeChambre->id]) }}">
        @csrf
        @method($typeChambre->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="type" label="Type de Chambre" type="text" name="type" placeholder="Type de Chambre"  readonly="" value="{{ $typeChambre->type }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="prix" label="Prix par nuit" type="text" name="prix_par_nuit" placeholder="Prix par nuit"  readonly="" value="{{ $typeChambre->prix_par_nuit }}" />
                <div class="col row mx-1">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ $typeChambre->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
