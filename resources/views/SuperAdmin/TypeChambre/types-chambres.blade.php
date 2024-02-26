@extends('SuperAdmin.layouts.template')

@section('title', 'Les Types de chambres')
@section('content-title', 'Liste de tous les Types de Chambres')

@section('content')

    @livewire('types-chambres-table')

@endsection
