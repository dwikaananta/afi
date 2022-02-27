@php
function rupiah($angka)
{
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}


function getBulan($no)
{
    if ($no == 1) {
        return 'Januari';
    }
    if ($no == 2) {
        return 'Februari';
    }
    if ($no == 3) {
        return 'Maret';
    }
    if ($no == 4) {
        return 'April';
    }
    if ($no == 5) {
        return 'Mei';
    }
    if ($no == 6) {
        return 'Juni';
    }
    if ($no == 7) {
        return 'Juli';
    }
    if ($no == 8) {
        return 'Agustus';
    }
    if ($no == 9) {
        return 'September';
    }
    if ($no == 1) {
        return 'Oktober';
    }
    if ($no == 11) {
        return 'November';
    }
    if ($no == 12) {
        return 'Desember';
    }
}
@endphp
