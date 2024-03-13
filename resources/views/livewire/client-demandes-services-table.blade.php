<div>
    <h1 class="fw-bold">Toutes vos réservations</h1>

    <div class="d-flex justify-content-between align-items-center">

        <div class="mt-2 mb-3 ml-5 d-flex">
            <input type="date" class="form-control w-50 mx-2 w-100" placeholder="Date de réservation" wire:model="dateReservation">
            <input type="date" class="form-control w-50 mx-2 w-100" placeholder="Début de séjour" wire:model="debutSejour">
            <input type="date" class="form-control w-50 mx-2 w-100" placeholder="Fin de Séjour" wire:model="finSejour">
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @forelse ($reservations as $k => $reservation)
                <div class="col-3">
                    <div class="card bg-light mb-3" style="max-width: 20rem; border-color: #73bad6;">
                        <div class="card-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Réservation N°{{ $k + 1 }}</font></font></div>
                        <div class="card-body">
                        <h5 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><strong>Réservation du {{ $reservation->date_reservation->translatedFormat('d F Y') }}</strong></font></font></h5>
                        <p class="card-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Démarre du {{ $reservation->debut_sejour->translatedFormat('d F Y') }} au {{ $reservation->fin_sejour->translatedFormat('d F Y') }}, pour un total de fonds de {{ $reservation->getMontant() }}$
                            à l'hôtel <a style="text-decoration: none;" href="{{ route('clients.hotels.show', ['slug' => $reservation->chambre->hotel->getSlug(), 'hotel' => $reservation->chambre->hotel->id]) }}">{{ $reservation->chambre->hotel->nom }}</a>
                            dans la chambre N° <a style="text-decoration: none;" href="{{ route('clients.chambres.show', ['slug' => $reservation->chambre->getSlug(), 'chambre' => $reservation->chambre->id]) }}">{{ $reservation->chambre->numero }}</a>.</font></font>
                        </p>
                        </div>
                        <div class="d-flex justify-content-end mx-4 mb-3">
                            <span class="badge bg-primary rounded-pill">{{ $reservation->isConfirmed() ? 'Confirmée' : 'Infirmée' }}</span>
                            @if ($reservation->chambre->isOccupied() && $reservation->isConfirmed())
                                <a style="text-decoration: none; font-size: 13.5px;" href="{{ route('clients.services', ['reservation' => $reservation->id]) }}" class="mx-2">Services <i class="fa-solid fa-arrow-right"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                Vous ne possédez aucune réservation dans aucun hôtel.
            @endforelse
        </div>
    </div>
    {{ $reservations->links() }}
</div>
