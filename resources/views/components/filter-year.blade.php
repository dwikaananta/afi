{{-- @props([
    'heading',
    'footer',
]) --}}

<div>
    <select onchange="window.location = window.location.href + this.value">
        <option value="">Pilih Tahun</option>
        <option value="?tahun=2020">2020</option>
        <option value="?tahun=2021">2021</option>
        <option value="?tahun=2022">2022</option>
    </select>
</div>