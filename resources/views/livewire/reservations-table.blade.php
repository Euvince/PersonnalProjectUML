<div class="row" x-data = "{ departementsChecked : @entangle('departementsChecked').defer }">
    <div class="search-box pull-left mt-5 ml-3">
        <input type="text" name="search" placeholder="Rechercher..." required wire:model="nom">
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-danger mb-3" style="color: white;" x-show="departementsChecked.length > 0" x-on:click="$wire.deletedDepartements(departementsChecked)" x-cloak><i class="fa fa-trash"></i> Supprimer</a>
            <a href="{{ route('super-admin.departements.create') }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Ajouter un Département</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Départements</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <td></td>
                                    <x-table-header label="ID" :direction="$orderDirection" name="id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Nom du Département" :direction="$orderDirection" name="nom" :field="$orderField"></x-table-header>
                                    <x-table-header label="Longitude" :direction="$orderDirection" name="longitude" :field="$orderField"></x-table-header>
                                    <x-table-header label="Lattitude" :direction="$orderDirection" name="lattitude" :field="$orderField"></x-table-header>
                                    <x-table-header label="Date de Création" :direction="$orderDirection" name="created_at" :field="$orderField"></x-table-header>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departements as $departement)
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox" x-model="departementsChecked" value="{{ $departement->id }}">
                                        </td>
                                        <th scope="row">{{ $departement->id }}</th>
                                        <td>{{ $departement->nom }}</td>
                                        <td>{{ $departement->longitude }}°</td>
                                        <td>{{ $departement->lattitude }}°</td>
                                        <td>{{ $departement->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('super-admin.departements.edit', ['departement' => $departement->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $departement->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $departement->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez-vous vraiment supprimer ce département ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                              <form action="{{ route('super-admin.departements.destroy', ['departement' => $departement->id]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Supprimer</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ml-4 mt-4">
        {{ $departements->links() }}
    </div>
</div>

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
            <a href="{{ route('clients.hotels.show', ['slug' => Str::slug($hotel->nom), 'hotel' => $hotel->id]) }}" class="btn btn-sm btn-primary">Visiter</a>
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
