<form action="" class="mb-3 w-100 d-flex" method="GET">
    <select class="form-select me-3" name="bulan">
        <option value="">Pilih Bulan</option>
        <option value="1" @if(isset($_GET['bulan']) && $_GET['bulan'] == 1) selected @endisset>Januari</option>
        <option value="2" @if(isset($_GET['bulan']) && $_GET['bulan'] == 2) selected @endisset>Februari</option>
        <option value="3" @if(isset($_GET['bulan']) && $_GET['bulan'] == 3) selected @endisset>Maret</option>
        <option value="4" @if(isset($_GET['bulan']) && $_GET['bulan'] == 4) selected @endisset>April</option>
        <option value="5" @if(isset($_GET['bulan']) && $_GET['bulan'] == 5) selected @endisset>Mei</option>
        <option value="6" @if(isset($_GET['bulan']) && $_GET['bulan'] == 6) selected @endisset>Juni</option>
        <option value="7" @if(isset($_GET['bulan']) && $_GET['bulan'] == 7) selected @endisset>Juli</option>
        <option value="8" @if(isset($_GET['bulan']) && $_GET['bulan'] == 8) selected @endisset>Agustus</option>
        <option value="9" @if(isset($_GET['bulan']) && $_GET['bulan'] == 9) selected @endisset>September</option>
        <option value="10" @if(isset($_GET['bulan']) && $_GET['bulan'] == 10) selected @endisset>Oktober</option>
        <option value="11" @if(isset($_GET['bulan']) && $_GET['bulan'] == 11) selected @endisset>November</option>
        <option value="12" @if(isset($_GET['bulan']) && $_GET['bulan'] == 12) selected @endisset>Desember</option>
    </select>

    <select class="form-select me-3" name="tahun">
        <option value="">Pilih Tahun</option>
        <option value="2022" @if(isset($_GET['tahun']) && $_GET['tahun'] == 2022) selected @endif>2022</option>
        <option value="2023" @if(isset($_GET['tahun']) && $_GET['tahun'] == 2023) selected @endif>2023</option>
        <option value="2024" @if(isset($_GET['tahun']) && $_GET['tahun'] == 2024) selected @endif>2024</option>
    </select>

    <button class="btn btn-sm btn-info text-white">Pilih</button>
</form>