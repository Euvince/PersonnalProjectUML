@extends('Client.layouts.template')

@section('content')

    @if (!auth()->user()->two_factor_secret)
        You have not enabled 2fa

        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Activer</button>
        </form>
    @else
        You have enabled 2fa
        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"class="btn btn-primary">Désactiver</button>
        </form>
    @endif

    @if (session('status') == 'two-factor-authentication-enabled')
        You have now enabled 2fa,
        please scan the following QR code into your phones authenticator application.
        {{!! auth()->user()->twoFactorQrCodeSvg() !!}}

        <p>Please store theses recovery codes in a secure location.</p>

        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
            {{ trim($code) }} <br>
        @endforeach

    @endif

@endsection
