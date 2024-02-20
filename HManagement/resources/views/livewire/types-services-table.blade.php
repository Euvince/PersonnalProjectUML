<div class="row" x-data = "{ typesChecked : @entangle('typesChecked').defer }">
    <div class="mt-5 ml-3 d-flex w-50">
        <input type="text" class="form-control w-50" placeholder="Le type..." wire:model="type">
        <input type="text" class="form-control w-50 ml-2" placeholder="Le prix..." wire:model="prix">
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-danger mb-3" style="color: white;" x-show="typesChecked.length > 0" x-on:click="$wire.deletedTypes(typesChecked)" x-cloak><i class="fa fa-trash"></i> Supprimer</a>
            <a href="{{ route('super-admin.type-service.create') }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Ajouter un Type de Service</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Types de Service</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <td></td>
                                    <x-table-header label="ID" :direction="$orderDirection" name="id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Type de Service" :direction="$orderDirection" name="type" :field="$orderField"></x-table-header>
                                    <x-table-header label="Prix ($)" :direction="$orderDirection" name="prix" :field="$orderField"></x-table-header>
                                    <x-table-header label="Date de Création" :direction="$orderDirection" name="created_at" :field="$orderField"></x-table-header>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox" x-model="typesChecked" value="{{ $type->id }}">
                                        </td>
                                        <th scope="row">{{ $type->id }}</th>
                                        <td>{{ $type->type }}</td>
                                        <td>{{ $type->prix }}$</td>
                                        <td>{{ $type->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('super-admin.type-service.edit', ['type_service' => $type->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $type->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $type->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez-vous vraiment supprimer ce type de service ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                              <form action="{{ route('super-admin.type-service.destroy', ['type_service' => $type->id]) }}" method="POST">
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
        {{ $types->links() }}
    </div>
</div>
