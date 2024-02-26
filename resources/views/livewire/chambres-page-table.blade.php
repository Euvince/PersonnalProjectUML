<div>
    <h1 class="fw-bold">Les chambres disponibles</h1>

    <div class="d-flex justify-content-between align-items-center">

        <div class="mt-2 mb-3 ml-5 d-flex">
            {{-- <select name="type_chambre_id" id="type_chambre_id" class="form-control" wire:model="selectedTypeChambre">
                @foreach ($types as $id => $type)
                    <option value="{{ $id }}">{{ $type }}</option>
                @endforeach
            </select> --}}
            <input type="text" class="form-control w-50 mx-2" placeholder="Type de chambre" wire:model="typechambre">
            <input type="text" class="form-control w-50 mx-2" placeholder="Numéro" wire:model="numero">
            <input type="text" class="form-control w-50 mx-2" placeholder="Libellé" wire:model="libelle">
            <input type="number" class="form-control w-50 mx-2" placeholder="Capacité" wire:model="capacite">
            <input type="text" class="form-control w-50 mx-2" placeholder="Description" wire:model="description">
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach ($chambres as $chambre)
                <div class="col-3">
                    <div class="card bg-secondary mb-3" style="max-width: 25rem;">
                        <img src="{{ asset('storage/images/image.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text" style="font-size: 13px;">Chambre N° : <strong>{{ $chambre->numero }}</strong></p>
                            <h6 class="card-title">{{ Str::limit( $chambre->libelle, 20, '...') }}</h6>
                            <p class="card-text" style="font-size: 13px;">Statut : <strong>{{ $chambre->statut }}</strong></p>
                            <p class="card-text" style="font-size: 13px;">Niveau : <strong>{{ $chambre->TypeChambre->type }}</strong></p>
                            <a href="{{ route('clients.chambres.show', ['slug' => Str::slug($chambre->libelle), 'chambre' => $chambre->id]) }}" class="btn btn-sm btn-primary">Voir plus...</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $chambres->links() }}
</div>
