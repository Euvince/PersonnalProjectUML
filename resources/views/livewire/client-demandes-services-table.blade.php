<div>
    <h1 class="fw-bold">Les services de la chambre</h1>

    <div class="d-flex justify-content-between align-items-center">

        <div class="mt-2 mb-3 ml-5 d-flex">
            <input type="text" class="form-control w-50 mx-2 w-100" placeholder="Type de service" wire:model="typeService">
            <input type="text" class="form-control w-50 mx-2 w-100" placeholder="Description" wire:model="description">
        </div>
    </div>

    <div class="container mt-4">
        <div class="">
            <a href="{{ route('clients.chambres.ask-service', ['chambre' => $reservation->chambre->id]) }}" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Demander un service</a>
        </div>
        <div class="row">
            @forelse ($services as $k => $service)
            <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chambre N°</font></font></th>
                    <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Type de service</font></font></th>
                    <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Description</font></font></th>
                    <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Prix($)</font></font></th>
                    <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Rendu ?</font></font></th>
                    <th scope="col" class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actions</font></font></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($services as $service)
                    <tr class="table-active">
                        <th scope="row"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $service->chambre->numero }}</font></font></th>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $service->TypeService->type }}</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $service->description }}</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $service->TypeService->prix }}$</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $service->isRendered() ? 'Oui' : 'Non' }}</font></font></td>
                        <td class="text-center">
                            <a href="{{ route('clients.chambres.edit-service', ['demande_service' => $service]) }}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                            <a href="" class="text-danger" data-bs-target="#modal{{ $service->id }}" data-bs-toggle="modal"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modal{{ $service->id }}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Annulation de demande de service ?</font></font></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer">
                                <span aria-hidden="true"></span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Souhaitez-vous vraiment annuler cette demande de service ?</font></font></p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('clients.chambres.service-cancel', ['demande_service' => $service->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Continuer</font></font></button>
                                  </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Annuler</font></font></button>
                            </div>
                          </div>
                        </div>
                    </div>
                  @endforeach
                </tbody>
              </table>
            @empty
                Aucun service demandé dans cette chambre.
            @endforelse
        </div>
    </div>
    {{ $services->links() }}
</div>
