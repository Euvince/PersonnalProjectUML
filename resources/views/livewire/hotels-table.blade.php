<div class="row" x-data = "{ hotelsChecked : @entangle('hotelsChecked').defer }">
    <div class="mt-5 ml-3 d-flex w-50">
        <input type="text" class="form-control w-50" placeholder="Rechercher..." wire:model="nom">
        <select id="" class="form-control w-50 ml-2" style="height: 44px;" wire:model="selectedQuartier" name="quartier_id">
            <option value="">Sélectionnez un Quartier</option>
            @foreach ($quartiers as $quartier)
                <option value="{{ $quartier->id }}">{{ $quartier->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-danger mb-3" style="color: white;" x-show="hotelsChecked.length > 0" x-on:click="$wire.deletedHotels(hotelsChecked)" x-cloak><i class="fa fa-trash"></i> Supprimer</a>
            <a href="{{ route('super-admin.hotels.create') }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Ajouter un Hôtel</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Hôtels</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <td></td>
                                    <x-table-header label="ID" :direction="$orderDirection" name="id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Nom de l'hôtel" :direction="$orderDirection" name="nom" :field="$orderField"></x-table-header>
                                    <x-table-header label="Longitude" :direction="$orderDirection" name="longitude" :field="$orderField"></x-table-header>
                                    <x-table-header label="Lattitude" :direction="$orderDirection" name="lattitude" :field="$orderField"></x-table-header>
                                    <x-table-header label="Quartier" :direction="$orderDirection" name="quartier_id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Date de Création" :direction="$orderDirection" name="created_at" :field="$orderField"></x-table-header>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hotels as $hotel)
                                    <tr>
                                        <td>
                                            <input type="checkbox" x-model="hotelsChecked" value="{{ $hotel->id }}">
                                        </td>
                                        <th scope="row">{{ $hotel->id }}</th>
                                        <td>{{ $hotel->nom }}</td>
                                        <td>{{ $hotel->longitude }}°</td>
                                        <td>{{ $hotel->lattitude }}°</td>
                                        <td>{{ $hotel?->quartier?->nom }}</td>
                                        <td>{{ $hotel->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('super-admin.hotels.show', ['hotel' => $hotel->id]) }}" class="text-primary"><i class="fa-solid fa-eye"></i></a></li>
                                                <li class="mr-3"><a href="{{ route('super-admin.hotels.edit', ['hotel' => $hotel->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $hotel->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $hotel->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez-vous vraiment supprimer cet hôtel ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                              <form action="{{ route('super-admin.hotels.destroy', ['hotel' => $hotel->id]) }}" method="POST">
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
        {{ $hotels->links() }}
    </div>
</div>
