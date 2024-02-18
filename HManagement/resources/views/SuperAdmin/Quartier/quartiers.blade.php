@extends('SuperAdmin.layouts.template')

@section('title', 'Les quartiers')
@section('content-title', 'Liste de tous les Quartiers')

@section('content')

    @livewire('quartiers-table')

@endsection
