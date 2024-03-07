<div class="row" >
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
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Chambres</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
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
                                        <th scope="row">{{ $chambre->id }}</th>
                                        <td>{{ $chambre->libelle }}</td>
                                        <td>{{ $chambre->numero }}</td>
                                        <td>{{ $chambre->statut }}</td>
                                        <td>{{ $chambre->capacite }}</td>
                                        <td>{{ $chambre?->typeChambre?->type }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('reception-personnal.chambres.show', ['chambre' => $chambre->id]) }}" class="text-primary"> Détails</a></li>
                                            </ul>
                                        </td>
                                    </tr>
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
