<div class="row" x-data = "{ chambresChecked : @entangle('chambresChecked').defer }">
    <div class="mt-5 ml-3 d-flex w-50">
        <input type="text" class="form-control w-50" placeholder="Numéro" wire:model="numero">
        <select id="" class="form-control w-50 ml-2" style="height: 44px;" wire:model="selectedTypeChambre" name="type_chambre_id">
            <option value="">Sélectionnez un Type de Chambre</option>
            @foreach ($typesChambres as $type)
                <option value="{{ $type->id }}">{{ $type->type }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-danger mb-3" style="color: white;" x-show="chambresChecked.length > 0" x-on:click="$wire.deletedChambres(chambresChecked)" x-cloak><i class="fa fa-trash"></i> Supprimer</a>
            <a href="{{ route('admin.chambres.create') }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Ajouter une Chambre</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Chambres</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <td></td>
                                    <x-table-header label="ID" :direction="$orderDirection" name="id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Libellé" :direction="$orderDirection" name="libelle" :field="$orderField"></x-table-header>
                                    <x-table-header label="Numéro" :direction="$orderDirection" name="numrero" :field="$orderField"></x-table-header>
                                    <x-table-header label="Statut" :direction="$orderDirection" name="statut" :field="$orderField"></x-table-header>
                                    <x-table-header label="Capacité" :direction="$orderDirection" name="capacite" :field="$orderField"></x-table-header>
                                    <x-table-header label="Type de chambre" :direction="$orderDirection" name="type_chambre_id" :field="$orderField"></x-table-header>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chambres as $chambre)
                                    <tr>
                                        <td>
                                            <input type="checkbox" x-model="chambresChecked" value="{{ $chambre->id }}">
                                        </td>
                                        <th scope="row">{{ $chambre->id }}</th>
                                        <td>{{ $chambre->libelle }}</td>
                                        <td>{{ $chambre->numero }}</td>
                                        <td>{{ $chambre->statut }}</td>
                                        <td>{{ $chambre->capacite }}</td>
                                        <td>{{ $chambre?->typeChambre?->type }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('admin.chambres.edit', ['chambre' => $chambre->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $chambre->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $chambre->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez-vous vraiment supprimer cette chambre ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                              <form action="{{ route('admin.chambres.destroy', ['chambre' => $chambre->id]) }}" method="POST">
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
        {{ $chambres->links() }}
    </div>
</div>
