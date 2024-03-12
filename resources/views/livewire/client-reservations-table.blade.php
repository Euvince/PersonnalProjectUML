<div>
    <h1 class="fw-bold">Toutes vos réservations</h1>

    <div class="d-flex justify-content-between align-items-center">

        <div class="mt-2 mb-3 ml-5 d-flex">
            <input style="width: 30%;" type="date" class="form-control w-50 mx-2" placeholder="Date de réservation" wire:model="dateReservation">
            <input type="date" class="form-control w-50 mx-2" placeholder="Début de séjour" wire:model="debutSejour">
            <input type="date" class="form-control w-50 mx-2" placeholder="Fin de Séjour" wire:model="finSejour">
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach ($reservations as $reservation)
                <div class="col-3">
                    <div class="card bg-light mb-3" style="max-width: 20rem;">
                        <div class="card-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Entête</font></font></div>
                        <div class="card-body">
                          <h4 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Titre de la carte légère</font></font></h4>
                          <p class="card-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Quelques exemples de texte rapides pour s'appuyer sur le titre de la carte et constituer l'essentiel du contenu de la carte.</font></font></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $reservations->links() }}
</div>
