@extends('SuperAdmin.layouts.template')

@section('title', 'Les factures')
@section('content-title', 'Liste de toutes les factures')

@section('content')

    @livewire('factures-table')

@endsection
