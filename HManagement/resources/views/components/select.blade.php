<div class="{{ $class1 }}">
    <label for="{{ $id }}" class="{{ $class2 }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $id }}" class="{{ $class3 }}">
        @foreach ($value as $id => $nom)
            <option @selected(old($name, $elementIdOnEntite) == $id) value="{{ $id }}">{{ $nom }}</option>
        @endforeach
    </select>
    @error($name)
        <span style="color: red;">{{ $message }}</span>
    @enderror
</div>
