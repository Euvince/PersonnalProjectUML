@extends('SuperAdmin.layouts.template')

@section('title', 'Les départements')
@section('content-title', 'Liste de tous les Départements')

@section('content')

    @livewire('departements-table')

@endsection
