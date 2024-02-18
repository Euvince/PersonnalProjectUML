@extends('SuperAdmin.layouts.template')

@section('title', $typeService->exists ? 'Éditer un Type de Service' : 'Créer un Type de Service')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $typeService->exists ? 'Éditer un Type de Service' : 'Créer un Type de Service' }}</h1>
    </div>

    <form method="POST" action="{{ route($typeService->exists ? 'super-admin.type-service.update' : 'super-admin.type-service.store', ['type_service' => $typeService->id]) }}">
        @csrf
        @method($typeService->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="type" label="Type de Service" type="text" name="type" placeholder="Type de Chambre"  readonly="" value="{{ $typeService->type }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="prix" label="Prix" type="text" name="prix" placeholder="Prix"  readonly="" value="{{ $typeService->prix }}" />
                <div class="col row mx-1">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-4">{{ $typeService->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection
