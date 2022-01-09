<div class="mb-2">
    @if ($label)
        <label for="">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror" value="{{ old($name) ? old($name) : $value }}"
        placeholder="{{ $placeholder }}" />
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
