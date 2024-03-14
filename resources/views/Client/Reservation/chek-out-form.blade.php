@extends('Client.layouts.template')

@section('title', 'Facturation finale')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Régler la facture finale ({{ $total_price }}$)</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    @if ($errors->has('error'))
        <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('error') }}</strong>
        </div>
    @endif

    <form id="form" method="POST" action="{{ route('clients.check-out-submitted', ['reservation' => $reservation->id]) }}">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col row">
                {{-- <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="prix_total" label="Prix Total" type="text" name="prix_total" placeholder="Prix Total"  readonly="readonly" value="" /> --}}
                <div id="card-element" class="form-control w-50 mt-4"></div>
                <input type="hidden" id="payment_method" name="payment_method">
            </div>
        </div>

        <button id="submit-button" type="submit" class="btn btn-primary my-4"><i class="fa-solid fa-circle-check"></i> Valider</button>
    </form>

@endsection

@section('extra-js')

    <script src="https://js.stripe.com/v3"></script>
    <script>

        const stripe = Stripe("{{ env('STRIPE_PUBLIQUE_KEY') }}");

        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            classes : {
                base : 'StripeElement bg-secondary mt-4 mx-2.5 rounded'
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
