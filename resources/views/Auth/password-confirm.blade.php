@extends('Auth.layouts.template')

@section('title', 'Confirmer mot de passe')

@section('content')

     <!-- login area start -->
     <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ url('user/confirm-password') }}" method="POST">
                    @csrf
                    <div class="login-form-head">
                        <h4>Confirmation de Mot de passe.</h4>
                        <p>Confirmer votre mot de passe pour continuer.</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="password">Mot de Passe</label>
                            <input type="password" id="password" name="password">
                            <i class="ti-user"></i>
                            <div class="text-danger" style="font-size: 0.7rem;">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Soumettre <i class="ti-arrow-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
