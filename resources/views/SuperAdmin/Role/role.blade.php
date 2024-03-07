@extends('SuperAdmin.layouts.template')

@section('title', 'Un Rôle spécifique')
@section('content-title', 'Détails d\'un Rôle')

@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="header-title">{{ $role->name }}</h4>
            <div class="single-table">
                <div class="row">
                    <div class="col">
                        <p><strong>Type de Rôle : </strong> {{ $role->TypeRole->type}}</p>
                        <p><strong>Rôle : </strong> {{ $role->name }}</p>
                        <p><strong>Crée le : </strong> {{ $role->created_at->format('d-m-Y') }} à {{ $role->created_at->format('H:i:s') }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Crée par : </strong> {{ $role->created_by != NULL ? $role->created_by : 'Système Hôteliers' }}</p>
                        <p><strong>Modifié le : </strong> {{ $role->updated_at->format('d-m-Y') }} à {{ $role->updated_at->format('H:i:s') }}</p>
                        <p><strong>Modifié par : </strong> {{ $role->updated_by != NULL ? $role->updated_by : 'Système Hôteliers' }}</p>
                    </div>
                    <div class="col">
                        <p><strong>Les permissions accordées : </strong> <br>
                            @foreach ($role->permissions as $permission)
                                -{{ $permission->name }}
                                @if (!$loop->last)
                                    , <br>
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
