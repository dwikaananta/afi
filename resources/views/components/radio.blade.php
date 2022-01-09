<div class="form-check {{ $inline ? 'form-check-inline' : '' }}">
    <input id="{{ $name . '_' . $value }}" type="radio" name="{{ $name }}" class="form-check-input @error($name) is-invalid @enderror"
        value="{{ old($name) ? old($name) : $value }}" placeholder="{{ $placeholder }}" />
    @if ($label)
        <label class="form-check-label" for="{{ $name . '_' . $value }}">
            {{ $label }}
        </label>
    @endif
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
