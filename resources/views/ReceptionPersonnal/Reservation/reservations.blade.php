@extends('SuperAdmin.layouts.template')

@section('title', 'Les réservations')
@section('content-title', 'Liste de toutes les réservations')

@section('content')

    @livewire('reception-personnal-reservations-table')

@endsection
