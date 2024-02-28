<div class="row">
    <div class="col row mx-1">
        <div class="form-group w-100">
            <label for="chambre_id" class="col-form-label mt-4">Chambre</label>
            <select name="chambre_id" id="chambre_id" class="form-control" wire:model="selectedChambre">
                @foreach ($chambres as $id => $chambre)
                    <option value="{{ $id }}">{{ $chambre }}</option>
                @endforeach
            </select>
            @error('chambre_id')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group col">
        <label for="prix_par_nuit" class="form-label mt-4">Prix par nuit</label>
            <input class="form-control" type="number" name="prix_par_nuit" placeholder="Prix par nuit" id="prix_par_nuit" value="{{-- {{ old('prix_par_nuit', $reservation->prix_par_nuit)  }} --}}" wire:model="price" readonly style="background: white;"/>
        @error('prix_par_nuit')
            <span style="color: red; font-size: 0.7rem">{{ $message }}</span>
        @enderror
    </div>
    <div class="col row mx-1">
    </div>
</div>
