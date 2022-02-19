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
            <h1>Detail Penjualan</h1>
        </div>

        <div class="border border-dark py-3">
            <div class="text-center">
                <h5>ALAM BUNGA BALI</h5>
                <h5>Jl. BY PASS NGURAH RAI TOHPATI, DENPASAR</h5>
                <h5>NO. TELP. 081232999000</h5>
            </div>

            <div class="row">
                <div class="col-3 ps-5">
                    User
                </div>
                <div class="col-9">
                    : {{ $penjualan->user ? $penjualan->user->nama : '' }}
                </div>
                <div class="col-3 ps-5">
                    Tgl Penjualan
                </div>
                <div class="col-9">
                    : {{ date('d-m-Y', strtotime($penjualan->tgl_penjualan)) }}
                </div>
                <div class="col-3 ps-5">
                    Kode Penjualan
                </div>
                <div class="col-9">
                    : {{ $penjualan->nota_penjualan }}
                </div>
                <div class="col-3 ps-5">
                    Nama
                </div>
                <div class="col-9">
                    : {{ $penjualan->nama }}
                </div>
                <div class="col-3 ps-5">
                    No Tlp
                </div>
                <div class="col-9">
                    : {{ $penjualan->no_tlp }}
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

            @if ($penjualan->detail_penjualan)
                <table class="w-100">
                    @foreach ($penjualan->detail_penjualan as $dp)
                        <tr>
                            <td class="ps-3">{{ $dp->tanaman ? getDetail($dp->tanaman->nama) : '' }}</td>
                            <td class="text-center">{{ $dp->qty }} PCS</td>
                            <td class="text-center">{{ rupiah($dp->harga_jual) }}</td>
                            <td class="text-end pe-3">{{ rupiah($dp->qty * $dp->harga_jual) }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif

            <div class="my-4 border-bottom border-dark"></div>

            <div class="row">
                <div class="col-6 text-center">Total</div>
                <div class="col-6 text-center">{{ rupiah($penjualan->total) }}</div>
            </div>
        </div>

        <x-btn-print />
    </div>
@endsection
