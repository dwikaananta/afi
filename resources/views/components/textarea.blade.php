<div class="mb-2">
    @if ($label)
        <label for="">{{ $label }}</label>
    @endif
    <textarea name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
        placeholder="{{ $placeholder }}" rows="4">{{ old($name) ? old($name) : $value }}</textarea>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
