@php
    $routeName = request()->route()->getName();
@endphp

@extends('Client.layouts.template')

@section('title', 'Demander un service')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{
                request()->route()->getName() === 'clients.chambres.edit-service'
                ? 'Éditer une demande de service' :
                'Procéder à une demande de service'
            }}
        </h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    @if ($errors->has('error'))
        <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('error') }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ /* $routeName === 'clients.chambres.edit-service' */ $demande_service->exists ? route('clients.chambres.service-update', ['demande_service' => $demande_service->id]) : route('clients.chambres.service-send', ['chambre' => $chambre->id]) }}">
        @csrf
        @method(/* $routeName === 'clients.chambres.edit-service' */ $demande_service->exists ? 'put' : 'post')
        <div class="row">
            <div>
                <label for="description" class="form-label mt-4">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $demande_service->description) }}</textarea>
                @error('description')
                    <span style="color: red; font-size: 0.7rem;">{{ $message }}</span>
                @enderror
            </div>
            <x-select class1="form-group w-100" class2="col-form-label mt-4" class3="form-control" id="type_service_id" label="Type de service" name="type_service_id" :value="$typesServices" elementIdOnEntite="{{ request()->route()->getName() === 'clients.chambres.edit-service' ? $demande_service->type_service_id : '' }}"/>
        </div>
        <button type="submit" class="btn btn-primary my-4">Soumettre</button>
    </form>

@endsection
