<div class="form-check {{ $inline ? 'form-check-inline' : '' }}">
    @php
        $is_checked = false;

        if (old($name) == $value) {
            $is_checked = true;
        } else {
            if ($checked == $value) {
                $is_checked = true;
            }
        }
    @endphp
    <input id="{{ $name . '_' . $value }}" type="radio" name="{{ $name }}" class="form-check-input @error($name) is-invalid @enderror"
        value="{{ $value }}" placeholder="{{ $placeholder }}" @if ($is_checked) checked="" @endif />
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
