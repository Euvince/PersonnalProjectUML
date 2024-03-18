<div class="row">
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
    </div>
</div>
