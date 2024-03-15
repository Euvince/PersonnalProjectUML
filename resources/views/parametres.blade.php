@extends('Client.layouts.template')

@section('content')

    @if (!auth()->user()->two_factor_secret)
        <h5><strong>Vous n'avez pas activer la double authentification</strong></h5>

        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Activer</button>
        </form>
    @else
        <h5><strong>Vous avez activer la double authentification</strong></h5>
        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"class="btn btn-primary">Désactiver</button>
        </form>
    @endif

    @if (session('status') == 'two-factor-authentication-enabled')
        Vous avez maintenant activé la double authentification,
        veuillez scanner le code QR suivant dans l'application d'authentification de votre téléphone.
        {{!! auth()->user()->twoFactorQrCodeSvg() !!}}

        <p>Veuillez conserver ces codes de récupération dans un endroit sécurisé.</p>

        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
            {{ trim($code) }} <br>
        @endforeach

    @endif

@endsection
