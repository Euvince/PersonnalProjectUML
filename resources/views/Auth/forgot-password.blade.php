@extends('Auth.layouts.template')

@section('title', 'Mot de passe oublié')

@section('content')

     <!-- login area start -->
     <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('password.request') }}" method="POST">
                    @csrf
                    <div class="login-form-head">
                        <h4>Mot de passe oublié ?</h4>
                        <p>Entrez votre adresse e-mail pour réinitialiser votre mot de passe.</p>
                    </div>
                    <div class="login-form-body">
                        @if (session('status'))
                            <div class="alert alert-success my-3">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-gp">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email"  value="{{ old('email') }}">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('email')
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
