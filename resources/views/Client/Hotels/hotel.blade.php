@extends('Client.layouts.template')

@section('title', 'Chambres')

@section('content')

    @livewire('chambres-page-table', [
        'hotel' => $hotel
    ])

@endsection
