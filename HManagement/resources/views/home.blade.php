<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if (!auth()->user()->two_factor_secret)
        You have not enabled 2fa

        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
            @csrf
            <button type="submit">Activer</button>
        </form>
    @else
        You have enabled 2fa
        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit">Désactiver</button>
        </form>
    @endif

    @if (session('status' == 'two-factor-authentication-enabled'))
        You have now enabled 2fa,
        please scan the following QR code into your phones authenticator application.
        {!! auth()->user()->twoFactorQrCodeSvg() !!}

        <p>Please store these recovery codes in a secure location.</p>

        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
            {{ trim($code) }} <br>
        @endforeach
    @endif
</body>
</html>
