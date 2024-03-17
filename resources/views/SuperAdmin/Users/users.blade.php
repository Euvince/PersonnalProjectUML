@extends('SuperAdmin.layouts.template')

@section('title', 'Les utilisateurs')
@section('content-title', 'Liste de tous les Utilisateurs')

@section('content')

    @livewire('super-admin-users-table')

@endsection
