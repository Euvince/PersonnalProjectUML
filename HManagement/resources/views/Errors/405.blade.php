@extends('Errors.layouts.template')

@section('title', '405 Not allowed')
@section('content')

    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- error area start -->
    <div class="error-area ptb--100 text-center">
        <div class="container">
            <div class="error-content">
                <h2>405</h2>
                <p>Méthode non supportée.</p>
                <a href="{{ route('statistiques') }}">Retour au Dashborad.</a>
            </div>
        </div>
    </div>
    <!-- error area end -->

@endsection
