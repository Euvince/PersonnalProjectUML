@extends('Auth.layouts.template')

@section('title', 'Réinitialiser mot de passe')

@section('content')

     <!-- login area start -->
     <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="login-form-head">
                        <h4>Réinitialisez votre mot de passe.</h4>
                        <p>Entrez un nouveau mot de passe pour modififer le précédent.</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email"  value="{{ $request->email }}">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-gp">
                            <label for="password">Mot de Passe</label>
                            <input type="password" id="password" name="password">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-gp">
                            <label for="password_confirmation">Confirmer Mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation">
                            <i class="ti-lock"></i>
                            <div class="text-danger">
                                @error('password_confirmation')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Envoyer <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
