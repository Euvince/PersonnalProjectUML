@extends('SuperAdmin.layouts.template')

@section('title', 'Les demandes de services')
@section('content-title', 'Liste de toutes les demandes de services')

@section('content')

    @livewire('service-personnal-demandes-services-table')

@endsection
