@extends('Auth.layouts.template')

@section('title', 'Vérification d\'email')

@section('content')

     <!-- login area start -->
     <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('verification.send') }}" method="POST">
                    @csrf
                    <div class="login-form-head">
                        <h4>Vérification d'adresse e-mail.</h4>
                        <p>Un courriel vous a été envoyé, vous devez vérifier votre adresese email.</p>
                    </div>
                    <div class="login-form-body">
                        @if (session('status'))
                            <div class="alert alert-success my-3">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Renvoyer le mail<i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
