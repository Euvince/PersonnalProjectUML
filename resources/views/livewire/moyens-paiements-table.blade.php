<div class="row" x-data = "{ moyensChecked : @entangle('moyensChecked').defer }">
    <div class="search-box pull-left mt-5 ml-3">
        <input type="text" name="search" placeholder="Rechercher..." required wire:model="moyen">
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-danger mb-3" style="color: white;" x-show="moyensChecked.length > 0" x-on:click="$wire.deletedMoyens(moyensChecked)" x-cloak><i class="fa fa-trash"></i> Supprimer</a>
            <a href="{{ route('super-admin.moyen-paiement.create') }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Ajouter un Moyen de Paiement</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Moyens de Paiements</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <td></td>
                                    <x-table-header label="ID" :direction="$orderDirection" name="id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Moyen de Paiement" :direction="$orderDirection" name="type" :field="$orderField"></x-table-header>
                                    <x-table-header label="Date de Création" :direction="$orderDirection" name="created_at" :field="$orderField"></x-table-header>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($moyens as $moyen)
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox" x-model="moyensChecked" value="{{ $moyen->id }}">
                                        </td>
                                        <th scope="row">{{ $moyen->id }}</th>
                                        <td>{{ $moyen->moyen }}</td>
                                        <td>{{ $moyen->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('super-admin.moyen-paiement.show', ['moyen_paiement' => $moyen->id]) }}" class="text-primary"><i class="fa-solid fa-eye"></i></a></li>
                                                <li class="mr-3"><a href="{{ route('super-admin.moyen-paiement.edit', ['moyen_paiement' => $moyen->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $moyen->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $moyen->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez-vous vraiment supprimer ce moyen de paiement ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                              <form action="{{ route('super-admin.moyen-paiement.destroy', ['moyen_paiement' => $moyen->id]) }}" method="POST">
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
        {{ $moyens->links() }}
    </div>
</div>
