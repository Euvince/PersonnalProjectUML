<div class="{{ $class1 }}">
    <label for="{{ $id }}" class="{{ $class2 }}">{{ $label }}</label>
    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $id }}" cols="30" rows="10" {{ $readonly }}>{{ old($name, $value) }}</textarea>
    @elseif ($type === 'text')
        <input class="{{ $class3 }}" type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" id="{{ $id }}" {{ $readonly }} value="{{ old($name, $value)  }}"/>
    @elseif($type === 'file')
        <input class="form-control" type="file" id="formFile">
    @else
        <input class="form-control" type="number" id="formFile">
    @endif
    @error($name)
        <span style="color: red; font-size: 0.7rem">{{ $message }}</span>
    @enderror
</div>