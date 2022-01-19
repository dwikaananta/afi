@php
function rupiah($angka)
{
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}


function getBulan($no)
{
    if ($no == 1) {
        return 'Jan';
    }
    if ($no == 2) {
        return 'Feb';
    }
    if ($no == 3) {
        return 'Mar';
    }
    if ($no == 4) {
        return 'Apr';
    }
    if ($no == 5) {
        return 'Mei';
    }
    if ($no == 6) {
        return 'Jun';
    }
    if ($no == 7) {
        return 'Jul';
    }
    if ($no == 8) {
        return 'Agt';
    }
    if ($no == 9) {
        return 'Sep';
    }
    if ($no == 1) {
        return 'Okt';
    }
    if ($no == 11) {
        return 'Nov';
    }
    if ($no == 12) {
        return 'Des';
    }
}
@endphp
