<div class="mb-2">
    @if ($label)
        <label for="">{{ $label }}</label>
    @endif

    <select name="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
        {{ $slot }}
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
