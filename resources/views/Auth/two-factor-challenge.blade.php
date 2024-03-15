@extends('Auth.layouts.template')

@section('title', 'Vérifcation de codes')

@section('content')

     <!-- login area start -->
     <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ url('/two-factor-challenge') }}" method="POST">
                    @csrf
                    <div class="login-form-head">
                        <h4>Confirmation de code</h4>
                        <p>Entrez votre code de vérification.</p>
                    </div>
                    <div class="login-form-body">
                        @if (session('status'))
                            <div class="alert alert-success my-3">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-gp">
                            <label for="code">Code</label>
                            <input type="text" id="code" name="code">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Soumettre <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
