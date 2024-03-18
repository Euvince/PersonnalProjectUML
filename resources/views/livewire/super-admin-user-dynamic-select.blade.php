<div class="row mt-4">
    <div class="col row mx-1">
        <div class="form-group w-100">
            <label for="departement_id" class="col-form-label">Département</label>
            <select name="departement_id" id="departement_id" class="form-control" wire:model="selectedDepartement">
                @foreach ($departements as $departement)
                    <option value="{{ $departement->id }}">{{ $departement->nom }}</option>
                @endforeach
            </select>
            @error('departement_id')
                <span style="color: red; font-size: 0.7rem;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col row mx-1">
        <div class="form-group w-100">
            <label for="commune_id" class="col-form-label">Commune</label>
            <select name="commune_id" id="commune_id" class="form-control" wire:model="selectedCommune">
                @foreach ($communes as $commune)
                    <option value="{{ $commune->id }}">{{ $commune->nom }}</option>
                @endforeach
            </select>
            @error('commune_id')
                <span style="color: red; font-size: 0.7rem;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col row mx-1">
        <div class="form-group w-100">
            <label for="arrondissement_id" class="col-form-label">Arrondissement</label>
            <select name="arrondissement_id" id="arrondissement_id" class="form-control" wire:model="selectedArrondissement">
                @foreach ($arrondissements as $arrondissement)
                    <option value="{{ $arrondissement->id }}">{{ $arrondissement->nom }}</option>
                @endforeach
            </select>
            @error('arrondissement_id')
                <span style="color: red; font-size: 0.7rem;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col row mx-1">
        <div class="form-group w-100">
            <label for="quartier_id" class="col-form-label">Quartier</label>
            <select name="quartier_id" id="quartier_id" class="form-control" wire:model="selectedQuartier">
                @foreach ($quartiers as $quartier)
                    <option value="{{ $quartier->id }}">{{ $quartier->nom }}</option>
                @endforeach
            </select>
            @error('quartier_id')
                <span style="color: red; font-size: 0.7rem;">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col row mx-1">
        <div class="form-group w-100">
            <label for="hotel_id" class="col-form-label">Hôtels</label>
            <select name="hotel_id" id="hotel_id" class="form-control" wire:model="selectedHotel">
                @foreach ($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->nom }}</option>
                @endforeach
            </select>
            @error('hotel_id')
                <span style="color: red; font-size: 0.7rem;">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
