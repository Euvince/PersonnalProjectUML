@extends('SuperAdmin.layouts.template')

@section('title', 'Les arrondissements')
@section('content-title', 'Liste de tous les Arrondissemnts')

@section('content')

    @livewire('arrondissements-table')

@endsection
