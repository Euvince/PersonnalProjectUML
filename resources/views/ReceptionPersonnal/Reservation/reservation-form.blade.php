@extends('SuperAdmin.layouts.template')

@section('title', $reservation->exists ? 'Éditer une Réservation' : 'Créer une Réservation')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">{{ $reservation->exists ? 'Éditer une Réservation' : 'Créer une Réservation' }}</h1>
    </div>

    @if (session('error'))
        <div class="alert alert-danger mt-2" role="alert">
            <strong>{{ session('error') }}</strong>
        </div>
    @endif

    <form id="form" method="POST" action="{{ route($reservation->exists ? 'reception-personnal.reservations.update' : 'reception-personnal.reservations.store', ['reservation' => $reservation->id]) }}">
        @csrf
        @method($reservation->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom_client" label="Nom du client" type="text" name="nom_client" placeholder="Nom"  readonly="" value="{{ $reservation->nom_client }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="prenoms_client" label="Prénoms du client" type="text" name="prenoms_client" placeholder="Prénoms"  readonly="" value="{{ $reservation->prenoms_client }}" />
                <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="email_client" label="Email du client" type="text" name="email_client" placeholder="Email" readonly="" value="{{ $reservation->email_client }}" />
            </div>
        </div>

        <div class="row">
            <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="telephone_client" label="Téléphone du client" type="text" name="telephone_client" placeholder="Téléphone"  readonly="" value="{{ $reservation->telephone_client }}" />
            <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="debut_sejour" label="Début du séjour" type="date" name="debut_sejour" placeholder="Début du séjour"  readonly="{{ $reservation->isConfirmed() ? 'readonly' : '' }}" value="{{ $reservation->debut_sejour->format('Y-m-d') }}" />
            <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="fin_sejour" label="Fin du séjour" type="date" name="fin_sejour" placeholder="Fin du séjour"  readonly="" value="{{ $reservation->fin_sejour->format('Y-m-d') }}" />
        </div>

        @livewire('reservation-dynamic-select', [
            'chambres' => $chambres,
            'reservation' => $reservation
        ])

        {{-- <div class="row">
            <div class="col row mx-1">
                <x-select class1="form-group w-100" class2="col-form-label mt-4" class3="form-control" id="chambre_id" label="Chambre" name="chambre_id" :value="$chambres" elementIdOnEntite="{{ $reservation->chambre_id }}"/>
            </div>
            <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="prix_par_nuit" label="Prix par nuit" type="number" name="prix_par_nuit" placeholder="Prix par nuit"  readonly="" value="{{ $reservation->prix_par_nuit }}" />
            <div class="col row mx-1">
            </div>
        </div> --}}

        <div class="row">
            <div class="col row">
                <div id="card-element" class="form-control w-50 mt-4"></div>
                <input type="hidden" id="payment_method" name="payment_method">
            </div>
        </div>

        <button id="submit-button" type="submit" class="btn btn-primary my-4">{{ $reservation->exists ? 'Modifier' : 'Enrégistrer' }}</button>
    </form>

@endsection

@section('extraaa-js')

    <script src="https://js.stripe.com/v3"></script>
    <script>

        const stripe = Stripe(" {{ env('STRIPE_PUBLIQUE_KEY') }}");

        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            classes : {
                base : 'StripeElement ml-3 mt-4 mx-2.5 rounded'
            }
        });
        cardElement.mount('#card-element');

        const submitButton = document.getElementById('submit-button');

        submitButton.addEventListener('click', async(e) => {
            e.preventDefault();

            const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement);
            if (error) {
                alert(error)
            } else {
                document.getElementById('payment_method').value = paymentMethod.id;
            }

            document.getElementById('form').submit();
        });

    </script>

@endsection
