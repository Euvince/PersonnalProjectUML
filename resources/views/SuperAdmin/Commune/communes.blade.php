@extends('SuperAdmin.layouts.template')

@section('title', 'Les communes')
@section('content-title', 'Liste de toutes les Communes')

@section('content')

    @livewire('communes-table')

@endsection
