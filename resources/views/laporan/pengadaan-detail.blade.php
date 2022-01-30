@extends('layouts.print')

@section('content')
    @php
    function rupiah($angka)
    {
        $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
    @endphp
    <div class="container">
        <div class="text-center">
            <h1>Detail Pengadaan</h1>
        </div>

        <div class="border border-dark py-3">
            <div class="row">
                <div class="col-3 ps-4">
                    User
                </div>
                <div class="col-9">
                    : {{ $pengadaan->user ? $pengadaan->user->nama : '' }}
                </div>
                <div class="col-3 ps-4">
                    Supplier
                </div>
                <div class="col-9">
                    : {{ $pengadaan->supplier ? $pengadaan->supplier->nama : '' }}
                </div>
                <div class="col-3 ps-4">
                    Tgl Pengadaan
                </div>
                <div class="col-9">
                    : {{ date('d-m-Y', strtotime($pengadaan->tgl_pengadaan)) }}
                </div>
                <div class="col-3 ps-4">
                    Nota Pengadaan
                </div>
                <div class="col-9">
                    : {{ $pengadaan->kode_pengadaan }}
                </div>
            </div>

            <div class="my-4 border-bottom border-dark"></div>

            @php
                function getDetail($t_nama) {
                    $nama = explode('||', $t_nama);
                    if (count($nama) == 2) {
                        echo $nama[0] . ' (' . $nama[1] . ')';
                    } else {
                        echo $t_nama;
                    }
                }
            @endphp

            @if ($pengadaan->detail_pengadaan)
                <table class="w-100">
                    @foreach ($pengadaan->detail_pengadaan as $dp)
                        <tr>
                            <td class="ps-3">{{ $dp->tanaman ? getDetail($dp->tanaman->nama) : '' }}</td>
                            <td class="text-center">{{ $dp->qty }} PCS</td>
                            <td class="text-center">{{ rupiah($dp->harga_beli) }}</td>
                            <td class="text-end pe-3">{{ rupiah($dp->qty * $dp->harga_beli) }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif

            <div class="my-4 border-bottom border-dark"></div>

            <div class="row">
                <div class="col-6 text-center">Total</div>
                <div class="col-6 text-center">{{ rupiah($pengadaan->total) }}</div>
            </div>
        </div>

        <x-btn-print />
    </div>
@endsection
