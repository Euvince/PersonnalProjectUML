<div class="row">
    <div class="mt-5 ml-3 d-flex w-50">
        <input type="text" class="form-control w-50" placeholder="Nom" wire:model="nom">
        <input type="text" class="form-control w-50 ml-2" placeholder="Nationnalité" wire:model="nationnalite">
    </div>
    <div class="col-12 mt-5">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Tous Les Clients</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <x-table-header label="ID" :direction="$orderDirection" name="id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Nom" :direction="$orderDirection" name="nom" :field="$orderField"></x-table-header>
                                    <x-table-header label="Prénoms" :direction="$orderDirection" name="prenoms" :field="$orderField"></x-table-header>
                                    <x-table-header label="Nationnalité" :direction="$orderDirection" name="nationnalite" :field="$orderField"></x-table-header>
                                    <td style="cursor: pointer; font-weight:bold;">Rôle(s)</td>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <th scope="row">{{ $client->id }}</th>
                                        <td>{{ $client->nom }}</td>
                                        <td>{{ $client->prenoms }}</td>
                                        <td>{{ $client->nationnalite }}</td>
                                        <td>
                                            @foreach ($client->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('admin.clients.show', ['user' => $client->id]) }}" class="text-success">Détails</a></li>
                                                <li><a href="" class="text-primary" data-target="#modal{{ $client->id }}" data-toggle="modal">Recruter</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $client->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Recrutement</h5>
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez-vous vraiment recruter ce client ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                              <form action="{{ route('admin.clients.recrutement', ['user' => $client->id]) }}" method="POST">
                                                @csrf
                                                @method('patch')
                                                <button class="btn btn-primary">Recruter</button>
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
        {{ $clients->links() }}
    </div>
</div>
