<div>
    <h1 class="fw-bold">Tous les Hôtels</h1>

    <div class="d-flex justify-content-between align-items-center">

        <div class="mt-2 mb-3 ml-5 d-flex">
            <input type="text" class="form-control w-50 mx-2" placeholder="Département" wire:model="departement">
            <input type="text" class="form-control w-50 mx-2" placeholder="Commune" wire:model="commune">
            <input type="text" class="form-control w-50 mx-2" placeholder="Arrondissement" wire:model="arrondissement">
            <input type="text" class="form-control w-50 mx-2" placeholder="Quartier" wire:model="quartier">
            <input type="text" class="form-control w-50 mx-2" placeholder="Nom" wire:model="nom">
        </div>
    </div>

    <div class="container mt-4">
        @if ($errors->has('error'))
            <div class="alert alert-danger" role="alert">
                <strong>{{ $errors->first('error') }}</strong>
            </div>
        @endif
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-4">
                    <div class="card bg-secondary mb-3" style="max-width: 25rem;">
                        {{-- <div class="card-header">
                            <strong>{{ $hotel->nom }}</strong>
                        </div> --}}
                        <img src="{{ asset('storage/images/image.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title">{{ Str::limit( $hotel->nom, 20, '...') }}</h6>
                            {{-- <p class="card-text" style="font-size: 13px;"><strong>{{ $hotel->adresse_postale }}</strong></p> --}}
                            <p class="card-text" style="font-size: 13px;">Directeur : <strong>{{ $hotel->directeur }}</strong></p>
                            <p class="card-text" style="font-size: 13px;"><strong>{{ $hotel->email }}</strong></p>
                            <a href="{{ route('clients.hotels.show', ['slug' => $hotel->getSlug(), 'hotel' => $hotel->id]) }}" class="btn btn-sm btn-primary mx-1"><i class="fa-solid fa-eye"></i> Visiter</a>
                            <a href="{{ route('clients.hotels.infos', ['slug' => $hotel->getSlug(), 'hotel' => $hotel->id]) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i> Informations</a>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-3">
                    <div class="card bg-secondary mb-3" style="max-width: 20rem;">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/images/image.png') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                              <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endforeach
        </div>
    </div>
    {{ $hotels->links() }}
</div>
