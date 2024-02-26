@extends('SuperAdmin.layouts.template')

@section('title', 'Les hôtels')
@section('content-title', 'Liste de tous les Hôtels')

@section('content')

    @livewire('hotels-table')

@endsection
