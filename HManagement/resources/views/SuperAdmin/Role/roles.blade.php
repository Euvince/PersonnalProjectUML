@extends('SuperAdmin.layouts.template')

@section('title', 'Les rôles')
@section('content-title', 'Liste de tous les rôles')

@section('content')

    @livewire('roles-table')

@endsection
