<div>
    <h1 class="fw-bold">Les chambres disponibles</h1>

    <div class="d-flex justify-content-between align-items-center">

        <div class="mt-2 mb-3 ml-5 d-flex">
            <input type="text" class="form-control w-50 mx-2" placeholder="Numéro" wire:model="departement">
            <input type="text" class="form-control w-50 mx-2" placeholder="Libellé" wire:model="commune">
            <input type="text" class="form-control w-50 mx-2" placeholder="Capacité" wire:model="arrondissement">
            <input type="text" class="form-control w-50 mx-2" placeholder="Type de chambre" wire:model="quartier">
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-4">
                    <div class="card bg-secondary mb-3" style="max-width: 25rem;">
                        <img src="{{ asset('storage/images/image.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title">{{ Str::limit( $hotel->nom, 20, '...') }}</h6>
                            <p class="card-text" style="font-size: 13px;">Directeur : <strong>{{ $hotel->directeur }}</strong></p>
                            <p class="card-text" style="font-size: 13px;"><strong>{{ $hotel->email }}</strong></p>
                            <a href="{{ route('clients.hotels.show', ['slug' => Str::slug($hotel->nom), 'hotel' => $hotel->id]) }}" class="btn btn-sm btn-primary">Visiter</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $hotels->links() }}
</div>
