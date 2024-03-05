<div class="row" x-data = "{ reservationsChecked : @entangle('reservationsChecked').defer }">
    <div class="mt-5 ml-3 d-flex w-50">
        {{-- <input type="text" class="form-control w-50" placeholder="Numéro de chambre" wire:model="numChambre"> --}}
        <input type="text" class="form-control w-50 ml-2" placeholder="Nom du client" wire:model="userFirstName">
        <input type="text" class="form-control w-50 ml-2" placeholder="Prénoms du client" wire:model="userLastName">
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-success mb-3" style="color: white;" x-show="reservationsChecked.length > 0" x-on:click="$wire.confirmReservations(reservationsChecked)" x-cloak><i class="fa-duotone fa-square-check"></i> Confirmer</a>
            <a href="{{ route('reception-personnal.reservations.create') }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Créer une Réservation</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Réservations</h4>
                <div class="row">
                    @foreach ($reservations as $reservation)
                        <div class="col-4">
                            <div class="card mb-3" style="background:#d6e9f4;">
                                <div class="card-body">
                                    <div>
                                        <input class="form-check-input" type="checkbox" x-model="reservationsChecked" value="{{ $reservation->id }}">
                                        <h6 class="card-title">{{-- {{ $reservation->nom_client }}  --}}{{ $reservation->prenoms_client }}</h6>
                                    </div>
                                    <p class="card-text" style="font-size: 13px;"><strong>{{ Str::limit($reservation->chambre->libelle, 25, '...') }}</strong></p>
                                    <li class="list-group-item list-group-item-primary d-flex justify-content-between align-items-center mb-3">
                                        <strong>{{  $reservation->statut }}</strong>
                                        <span class="badge bg-primary rounded-pill">{{ number_format($reservation->getMontant(), 0, ',', '.')}}$</span>
                                    </li>
                                    <a href="" class="btn btn-primary btn-sm" data-target="#modal{{ $reservation->id }}" data-toggle="modal">Valider</a>
                                    <a href="{{ route('reception-personnal.reservations.edit', ['reservation' => $reservation->id]) }}" class="btn btn-success btn-sm">Éditer</a>
                                    <a href="" class="btn btn-danger btn-sm">Annuler</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" tabindex="-1" id="modal{{ $reservation->id }}">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Confirmation de validation</h5>
                                </div>
                                <div class="modal-body">
                                  <p>Souhaitez-vous vraiment valider cette réservation ?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                  <form action="{{ route('reception-personnal.reservation.confirm', ['reservation' => $reservation->id]) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <button class="btn btn-primary">Valider</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="ml-4 mt-4">
        {{ $reservations->links() }}
    </div>
</div>
