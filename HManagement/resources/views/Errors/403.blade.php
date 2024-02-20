@extends('Errors.layouts.template')

@section('title', '403 Forbidden')
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
                <h2>403</h2>
                <p>Forbidden.</p>
                <a href="{{ route('statistiques') }}">Retour au Dashborad.</a>
            </div>
        </div>
    </div>
    <!-- error area end -->

@endsection
