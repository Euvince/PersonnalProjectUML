@extends('SuperAdmin.layouts.template')

@section('title', 'Les Moyens de Paiements')
@section('content-title', 'Liste de tous les Moyens de Paiements')

@section('content')

    @livewire('moyens-paiements-table')

@endsection
