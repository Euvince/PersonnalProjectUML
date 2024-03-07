@extends('SuperAdmin.layouts.template')

@section('title', 'Les chambres')
@section('content-title', 'Liste de toutes les Chambres')

@section('content')

    @livewire('reception-personnal-chambres-table')

@endsection
