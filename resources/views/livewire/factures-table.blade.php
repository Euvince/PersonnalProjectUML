<div class="row" x-data = "{ facturesChecked : @entangle('facturesChecked').defer }">
    <div class="mt-5 ml-3 d-flex w-50">
        <input type="text" class="form-control w-50 ml-2" placeholder="Nom du client" wire:model="userFirstName">
        <input type="text" class="form-control w-50 ml-2" placeholder="Prénoms du client" wire:model="userLastName">
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-primary mb-3 mx-2" style="color: white;" x-show="facturesChecked.length > 0" x-on:click="$wire.downloadFactures(facturesChecked)" x-cloak><i class="fa-solid fa-download"></i> Télécharger</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Factures</h4>
                <div class="row">
                    @foreach ($factures as $facture)
                        <div class="col-4">
                            <div class="card mb-3" style="background:#d6e9f4;">
                                <div class="card-body">
                                    <div>
                                        <input class="form-check-input" type="checkbox" x-model="facturesChecked" value="{{ $facture->id }}">
                                        <h6 class="card-title">{{-- {{ $facture->nom_client }}  --}}{{ $facture->prenoms_client }}</h6>
                                    </div>
                                    <p class="card-text" style="font-size: 13px;"><strong>{{ $facture->paiement->reservation->chambre->libelle }}</strong></p>
                                    <li class="list-group-item list-group-item-primary d-flex justify-content-between align-items-center mb-3">
                                        <strong>{{  $facture->paiement->reservation->statut }}</strong>
                                        <span class="badge bg-primary rounded-pill">{{ number_format($facture->montant_total, 0, ',', '.')}}$</span>
                                    </li>
                                    <div class="d-flex mx-3">
                                        <form action="" method="POST" class="mx-1">
                                            @csrf
                                            @method('patch')
                                            <button class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i> Télécharger</button>
                                        </form>
                                        <a href="{{ route('reception-personnal.factures.show', ['facture' => $facture->id]) }}" class="btn btn-success btn-sm mx-1"><i class="fa-solid fa-eye"></i> Détails</a>
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
        {{ $factures->links() }}
    </div>
</div>
