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
            <a href="" class="btn btn-primary mb-3 ml-1"><i class="fa fa-plus"></i> Demander un service</a>
        </div>
        <div class="row">
            @forelse ($services as $k => $service)
            <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Taper</font></font></th>
                    <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">En-tête de colonne</font></font></th>
                    <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">En-tête de colonne</font></font></th>
                    <th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">En-tête de colonne</font></font></th>
                    <th scope="col" class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actions</font></font></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table-active">
                    <th scope="row"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actif</font></font></th>
                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contenu de la colonne</font></font></td>
                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contenu de la colonne</font></font></td>
                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contenu de la colonne</font></font></td>
                    <td class="text-center">
                        <a href="" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                        <a href="" class="text-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <tr class="table-active table-striped">
                    <th scope="row"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actif</font></font></th>
                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contenu de la colonne</font></font></td>
                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contenu de la colonne</font></font></td>
                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contenu de la colonne</font></font></td>
                    <td class="text-center">
                        <a href="" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                        <a href="" class="text-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            @empty
                Aucun service demandé dans cette chambre.
            @endforelse
        </div>
    </div>
    {{ $services->links() }}
</div>
