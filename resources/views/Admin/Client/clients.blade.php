@extends('SuperAdmin.layouts.template')

@section('title', 'Les clients')
@section('content-title', 'Liste de tous les Clients recherchant des Hôtels')

@section('content')

    @livewire('clients-table')

@endsection
