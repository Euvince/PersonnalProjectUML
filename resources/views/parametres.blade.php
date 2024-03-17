@extends('Client.layouts.template')

@section('content')
    @dump(session('status'))
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

    <div class="row">
        @if (session('status') == 'two-factor-authentication-enabled')
            <div class="col">
                Vous avez maintenant activé la double authentification,
                veuillez scanner le code QR suivant dans l'application d'authentification de votre téléphone.
                {!! auth()->user()->twoFactorQrCodeSvg() !!}

                <form action="{{ /* url('user/confirmed-two-factor-authentication') */ route('two-factor.confirm') }}" method="POST" class="mt-3">
                    <h3>Entrer ici le code de vérification obtenue à partir de Code Qr pour confirmer la double authentification</h3>
                    @csrf
                    <div class="row">
                        <div class="">
                            <input type="text" name="code" class="form-control" style="width: 50%;">
                            @error('code')
                                {{ $message }}
                            @enderror
                            <button type="submit" class="btn btn-primary btn-small mt-2">Confirmer</button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
        @if (session('status') == 'two-factor-authentication-confirmed')
            <div class="col">
                <h3>La double authentification est confirmée avec succès.</h3>
                <p>Veuillez conserver ces codes de récupération dans un endroit sécurisé.</p>
                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                    {{ trim($code) }} <br>
                @endforeach
            </div>
        @endif
    </div>

@endsection
