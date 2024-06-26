@extends('Auth.layouts.template')

@section('title', 'Connexion')

@section('content')

     <!-- login area start -->
     <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="login-form-head">
                        <h4>Se Connecter</h4>
                        <p>Salut, entrez vos informations de connexion pour accéder à votre compte.</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email"  value="{{ old('email') }}">
                            <i class="fa-solid fa-envelope"></i>
                            <div class="text-danger" style="font-size: 0.7rem;">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-gp">
                            <label for="password">Mot de Passe</label>
                            <input type="password" id="password" name="password">
                            <i class="fa-solid fa-lock"></i>
                            <div class="text-danger" style="font-size: 0.7rem;">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Se souvenir.</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ url('forgot-password') }}">Mot de passe oublié ?</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Connexion<i class="ti-arrow-right"></i></button>
                            <div class="login-other row mt-4">
                                <div class="col-6">
                                    <a class="fb-login" href="#">Se connecter avec <i class="fa fa-facebook"></i></a>
                                </div>
                                <div class="col-6">
                                    <a class="google-login" href="#">Se connecter avec  <i class="fa fa-google"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Vous n'avez pas de compte ? <a href="{{ route('register') }}">S'enrégister</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
