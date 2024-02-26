<div class="row">

    @php
        $routeName = request()->route()->getName();
    @endphp

    <div class="col row">
        <div class="col row mx-1">
            <div class="form-group w-100">
                <label for="name" class="col-form-label">Rôle</label>
                <input type="text" class="form-control" style="height: 38px;" name="name" value="{{ $role->name }}">
                @error('name')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col row mx-1">
            <div class="form-group w-100">
                <label for="type_role_id" class="col-form-label">Type de Rôle</label>
                <select name="type_role_id" id="type_role_id" class="form-control" wire:model="selectedTypeRole">
                    @foreach ($typeroles as $id => $typerole)
                        <option value="{{ $id }}">{{ $typerole }}</option>
                    @endforeach
                </select>
                @error('departement_id')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col row">
            <div class="form-group w-100">
                <select class="form-control" placeholder="Choisissez quelques permissions" name="permissions[]" wire:model="selectedPermissions" multiple="multiple">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission['id'] }}">{{ $permission['name'] }}</option>
                    @endforeach
                </select>
                @error('permissions')
                    <span style="color: red; font-size: 0.7rem">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

