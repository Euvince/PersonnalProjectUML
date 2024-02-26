@extends('SuperAdmin.layouts.template')

@section('title', 'Les Types de services')
@section('content-title', 'Liste de tous les Types de Services')

@section('content')

    @livewire('types-services-table')

@endsection
