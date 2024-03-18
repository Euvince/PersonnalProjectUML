<div class="row" x-data = "{ quartiersChecked : @entangle('quartiersChecked').defer }">
    <div class="mt-5 ml-3 d-flex w-50">
        <input type="text" class="form-control w-50" placeholder="Rechercher..." wire:model="nom">
        <select id="" class="form-control w-50 ml-2" style="height: 44px;" wire:model="selectedArrondissement" name="arrondissement_id">
            <option value="">Sélectionnez un Arrondissement</option>
            @foreach ($arrondissements as $arrondissement)
                <option value="{{ $arrondissement->id }}">{{ $arrondissement->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-danger mb-3" style="color: white;" x-show="quartiersChecked.length > 0" x-on:click="$wire.deletedQuartiers(quartiersChecked)" x-cloak><i class="fa fa-trash"></i> Supprimer</a>
            <a href="{{ route('super-admin.quartiers.create') }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Ajouter un Quartier</a>
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
                <h4 class="header-title">Quartiers</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <td></td>
                                    <x-table-header label="ID" :direction="$orderDirection" name="id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Nom du quartier" :direction="$orderDirection" name="nom" :field="$orderField"></x-table-header>
                                    <x-table-header label="Longitude" :direction="$orderDirection" name="longitude" :field="$orderField"></x-table-header>
                                    <x-table-header label="Lattitude" :direction="$orderDirection" name="lattitude" :field="$orderField"></x-table-header>
                                    <x-table-header label="Arrondissement" :direction="$orderDirection" name="arrondissement_id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Date de Création" :direction="$orderDirection" name="created_at" :field="$orderField"></x-table-header>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quartiers as $quartier)
                                    <tr>
                                        <td>
                                            <input type="checkbox" x-model="quartiersChecked" value="{{ $quartier->id }}">
                                        </td>
                                        <th scope="row">{{ $quartier->id }}</th>
                                        <td>{{ $quartier->nom }}</td>
                                        <td>{{ $quartier->longitude }}°</td>
                                        <td>{{ $quartier->lattitude }}°</td>
                                        <td>{{ $quartier?->arrondissement?->nom }}</td>
                                        <td>{{ $quartier->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('super-admin.quartiers.show', ['quartier' => $quartier->id]) }}" class="text-primary"><i class="fa-solid fa-eye"></i></a></li>
                                                <li class="mr-3"><a href="{{ route('super-admin.quartiers.edit', ['quartier' => $quartier->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $quartier->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $quartier->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez-vous vraiment supprimer ce quartier ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                              <form action="{{ route('super-admin.quartiers.destroy', ['quartier' => $quartier->id]) }}" method="POST">
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
        {{ $quartiers->links() }}
    </div>
</div>
