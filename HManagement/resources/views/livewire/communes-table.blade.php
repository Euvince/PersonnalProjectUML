<div class="row" x-data = "{ communesChecked : @entangle('communesChecked').defer }">
    <div class="mt-5 ml-3 d-flex w-50">
        <input type="text" class="form-control w-50" placeholder="Rechercher..." wire:model="nom">
        <select id="" class="form-control w-50 ml-2" style="height: 44px;" wire:model="selectedDepartement" name="departement_id">
            <option value="">Sélectionnez un Département</option>
            @foreach ($departements as $departement)
                <option value="{{ $departement->id }}">{{ $departement->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-danger mb-3" style="color: white;" x-show="communesChecked.length > 0" x-on:click="$wire.deletedCommunes(communesChecked)" x-cloak><i class="fa fa-trash"></i> Supprimer</a>
            <a href="{{ route('super-admin.communes.create') }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Ajouter une Commune</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Communes</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <td></td>
                                    <x-table-header label="ID" :direction="$orderDirection" name="id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Nom de la Commune" :direction="$orderDirection" name="nom" :field="$orderField"></x-table-header>
                                    <x-table-header label="Longitude" :direction="$orderDirection" name="longitude" :field="$orderField"></x-table-header>
                                    <x-table-header label="Lattitude" :direction="$orderDirection" name="lattitude" :field="$orderField"></x-table-header>
                                    <x-table-header label="Département" :direction="$orderDirection" name="departement_id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Date de Création" :direction="$orderDirection" name="created_at" :field="$orderField"></x-table-header>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($communes as $commune)
                                    <tr>
                                        <td>
                                            <input type="checkbox" x-model="communesChecked" value="{{ $commune->id }}">
                                        </td>
                                        <th scope="row">{{ $commune->id }}</th>
                                        <td>{{ $commune->nom }}</td>
                                        <td>{{ $commune->longitude }}°</td>
                                        <td>{{ $commune->lattitude }}°</td>
                                        <td>{{ $commune?->departement?->nom }}</td>
                                        <td>{{ $commune->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('super-admin.communes.edit', ['commune' => $commune->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $commune->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $commune->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez-vous vraiment supprimer cette commune ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                              <form action="{{ route('super-admin.communes.destroy', ['commune' => $commune->id]) }}" method="POST">
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
        {{ $communes->links() }}
    </div>
</div>
