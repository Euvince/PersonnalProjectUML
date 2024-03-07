@extends('SuperAdmin.layouts.template')

@section('title', 'Un Type de Service spécifique')
@section('content-title', 'Détails d\'un Type de Service')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $typeService->type }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Numéro : </strong> {{ $typeService->id }}</p>
                        <p><strong>Type : </strong> {{ $typeService->type }}</p>
                        <p><strong>Crée le : </strong> {{ $typeService->created_at->format('d-m-Y') }} à {{ $typeService->created_at->format('H:i:s') }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Crée par : </strong> {{ $typeService->created_by != NULL ? $typeService->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $typeService->updated_at->format('d-m-Y') }} à {{ $typeService->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $typeService->updated_by != NULL ? $typeService->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
