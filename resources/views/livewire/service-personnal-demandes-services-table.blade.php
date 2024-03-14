<div class="row" x-data = "{ servicesChecked : @entangle('servicesChecked').defer }">
    <div class="mt-5 ml-3 d-flex w-50">
        {{-- <input type="text" class="form-control w-50" placeholder="Numéro de chambre" wire:model="numChambre"> --}}
        <input type="text" class="form-control w-50 ml-2" placeholder="Nom du client" wire:model="userFirstName">
        <input type="text" class="form-control w-50 ml-2" placeholder="Prénoms du client" wire:model="userLastName">
    </div>
    <div class="col-12 mt-5">
        <div class="row ml-2">
            <a class="btn btn-danger mb-3 mx-2" style="color: white;" x-show="servicesChecked.length > 0" x-on:click="$wire.cannotRanderedServices(servicesChecked)" x-cloak><i class="fa fa-x"></i></a>
            {{-- <a class="btn btn-success mb-3" style="color: white;" x-show="servicesChecked.length > 0" x-on:click="$wire.confirmServices(servicesChecked)" x-cloak><i class="fa-solid fa-circle-check"></i></a> --}}
            <a class="btn btn-danger mb-3 mx-2" style="color: white;" x-show="servicesChecked.length > 0" x-on:click="$wire.cancelServices(servicesChecked)" x-cloak><i class="fa fa-trash"></i></a>
            <a href="{{ route('service-personnal.demande-service.create') }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Créer une demande de service</a>
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
                <h4 class="header-title">Demandes de services</h4>
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-4">
                            <div class="card mb-3" style="background:#d6e9f4;">
                                <div class="card-body">
                                    <div>
                                        <input class="form-check-input" type="checkbox" x-model="servicesChecked" value="{{ $service->id }}">
                                        <h6 class="card-title">{{-- {{ $service->nom_client }}  --}}{{ $service->prenoms_client }}</h6>
                                    </div>
                                    <span>{{ $service->date_demande_service->translatedFormat('d F Y') }}</span>
                                    <p class="card-text" style="font-size: 13px;"><strong>{{ Str::limit($service->chambre->libelle, 25, '...') }}</strong></p>
                                    <li class="list-group-item list-group-item-primary d-flex justify-content-between align-items-center mb-3">
                                        <strong>{{  $service->statut }}</strong>
                                        @if ($service->isRendered())
                                            <span class="badge bg-primary rounded-pill" style="color: white;">Rendu</span>
                                        @endif
                                        <span class="badge bg-primary rounded-pill">{{ number_format($service->TypeService->prix, 0, ',', '.')}}$</span>
                                    </li>
                                    <div class="d-flex">
                                        @if (!$service->isRendered())
                                            <form action="{{ route('service-personnal.demande.confirm', ['demande_service' => $service->id]) }}" method="POST" class="mx-1">
                                                @csrf
                                                @method('patch')
                                                <button class="btn btn-success btn-sm"><i class="fa-solid fa-circle-check"></i> </button>
                                            </form>
                                            <a href="{{ route('service-personnal.demande.cannotrendered', ['demande_service' => $service->id]) }}" class="btn btn-danger btn-sm mx-1"><i class="fa-solid fa-x"></i></a>
                                        @endif
                                        <a href="{{ route('service-personnal.demande-service.show', ['demande_service' => $service->id]) }}" class="btn btn-primary btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                        @if (!$service->isRendered())
                                            <a href="{{ route('service-personnal.demande-service.edit', ['demande_service' => $service->id]) }}" class="btn btn-warning btn-sm mx-1"><i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-danger btn-sm mx-1"  data-target="#modal{{ $service->id }}" data-toggle="modal"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" tabindex="-1" id="modal{{ $service->id }}">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Confirmation d'annulation</h5>
                                </div>
                                <div class="modal-body">
                                  <p>Souhaitez-vous vraiment annuler cette demande de service ? Cette opération est irréversible.</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                  <form action="{{ route('service-personnal.demande-service.destroy', ['demande_service' => $service->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-primary">Continuer</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="ml-4 mt-4">
        {{ $services->links() }}
    </div>
</div>
