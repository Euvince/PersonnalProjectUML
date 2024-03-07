@extends('SuperAdmin.layouts.template')

@section('title', 'Un Type de Chambre spécifique')
@section('content-title', 'Détails d\'un Type de Chambre')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $typeChambre->type }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Numéro : </strong> {{ $typeChambre->id }}</p>
                        <p><strong>Type : </strong> {{ $typeChambre->type }}</p>
                        <p><strong>Crée le : </strong> {{ $typeChambre->created_at->format('d-m-Y') }} à {{ $typeChambre->created_at->format('H:i:s') }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Crée par : </strong> {{ $typeChambre->created_by != NULL ? $typeChambre->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $typeChambre->updated_at->format('d-m-Y') }} à {{ $typeChambre->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $typeChambre->updated_by != NULL ? $typeChambre->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
