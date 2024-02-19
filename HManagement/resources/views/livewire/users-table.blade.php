<div class="row" x-data = "{ usersChecked : @entangle('usersChecked').defer }">
    <div class="mt-5 ml-3 d-flex w-50">
        <input type="text" class="form-control w-50" placeholder="Nom" wire:model="nom">
        <input type="text" class="form-control w-50 ml-2" placeholder="Nationnalité" wire:model="nationnalite">
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-danger mb-3" style="color: white;" x-show="usersChecked.length > 0" x-on:click="$wire.deletedUsers(usersChecked)" x-cloak><i class="fa fa-trash"></i> Supprimer</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Utilisateurs</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <td></td>
                                    <x-table-header label="ID" :direction="$orderDirection" name="id" :field="$orderField"></x-table-header>
                                    <x-table-header label="Nom" :direction="$orderDirection" name="nom" :field="$orderField"></x-table-header>
                                    <x-table-header label="Prénoms" :direction="$orderDirection" name="nom" :field="$orderField"></x-table-header>
                                    <x-table-header label="Email" :direction="$orderDirection" name="email" :field="$orderField"></x-table-header>
                                    <x-table-header label="Nationnalité" :direction="$orderDirection" name="nationnalite" :field="$orderField"></x-table-header>
                                    <x-table-header label="Date de Naissance" :direction="$orderDirection" name="date_naissance" :field="$orderField"></x-table-header>
                                    <td style="cursor: pointer; font-weight:bold;">Rôles</td>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox" x-model="usersChecked" value="{{ $user->id }}">
                                        </td>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->nom }}</td>
                                        <td>{{ $user->prenoms }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nationnalite }}</td>
                                        <td>{{ $user->date_naissance }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $user->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $user->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez-vous vraiment supprimer cet utilisateur ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                              <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
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
        {{ $users->links() }}
    </div>
</div>
