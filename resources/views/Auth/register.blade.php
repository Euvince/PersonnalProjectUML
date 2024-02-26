@extends('Auth.layouts.template')

@section('title', 'Enrégistrement')

@section('content')

    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="login-form-head">
                        <h4>Créer un compte</h4>
                        <p>Enrégistrez-vous et profitez de nos offres un peu partout.</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" value="{{ old('nom') }}">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('nom')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-gp">
                            <label for="prenoms">Prénoms</label>
                            <input type="text" id="prenoms" name="prenoms"  value="{{ old('prenoms') }}">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('prenoms')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-gp">
                            <label for="date_naissance">Date de Naissance</label>
                            <input type="date" id="date_naissance" name="date_naissance"  value="{{ old('date_naissance') }}">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('date_naissance')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-gp">
                            <label for="sexe">Sexe</label>
                            <input type="text" id="sexe" name="sexe" value="{{ old('sexe') }}">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('sexe')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-gp">
                            <label for="nationnalite">Nationnalité</label>
                            <input type="text" id="nationnalite" name="nationnalite"  value="{{ old('nationnalite') }}">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('nationnalite')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
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
                        <div class="form-gp">
                            <label for="telephone">Téléphone</label>
                            <input type="text" id="telephone" name="telephone"  value="{{ old('telephone') }}">
                            <i class="ti-user"></i>
                            <div class="text-danger">
                                @error('telephone')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-gp">
                            <label for="password">Mot de Passe</label>
                            <input type="password" id="password" name="password">
                            <i class="ti-lock"></i>
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
                            <button id="form_submit" type="submit">Soumettre <i class="ti-arrow-right"></i></button>
                            <div class="login-other row mt-4">
                                <div class="col-6">
                                    <a class="fb-login" href="#">S'enrégister avec <i class="fa fa-facebook"></i></a>
                                </div>
                                <div class="col-6">
                                    <a class="google-login" href="#">S'enrégister avec <i class="fa fa-google"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

