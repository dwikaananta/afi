@extends('layouts.main')

@section('content')
    @php
    function rupiah($angka)
    {
        $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
    @endphp
    <div class="container">
        <div class="border border-dark py-3">

            <div class="row">
                <div class="col-3 ps-4">
                    User
                </div>
                <div class="col-9">
                    : {{ $penjualan->user ? $penjualan->user->nama : '' }}
                </div>
                <div class="col-3 ps-4">
                    Tgl Penjualan
                </div>
                <div class="col-9">
                    : {{ date('d-m-Y', strtotime($penjualan->tgl_penjualan)) }}
                </div>
                <div class="col-3 ps-4">
                    Nota Penjualan
                </div>
                <div class="col-9">
                    : {{ $penjualan->nota_penjualan }}
                </div>
                <div class="col-3 ps-4">
                    Nama
                </div>
                <div class="col-9">
                    : {{ $penjualan->nama }}
                </div>
                <div class="col-3 ps-4">
                    No Tlp
                </div>
                <div class="col-9">
                    : {{ $penjualan->no_tlp }}
                </div>
            </div>

            <div class="my-4 border-bottom border-dark"></div>

            @if ($penjualan->detail_penjualan)
                @foreach ($penjualan->detail_penjualan as $dp)
                    <div class="row">
                        <div class="col-3 ps-4">
                            @php
                                if ($dp->tanaman) {
                                    $nama = explode('||', $dp->tanaman->nama);
                                    if (count($nama) == 2) {
                                        echo $nama[0] . '<br /> (' . $nama[1] . ')';
                                    } else {
                                        echo $dp->tanaman->nama;
                                    }
                                }
                            @endphp
                        </div>
                        <div class="col-3 text-center">{{ $dp->qty }} PCS</div>
                        <div class="col-3 text-center">{{ rupiah($dp->harga_jual) }}</div>
                        <div class="col-3 text-end pe-4">{{ rupiah($dp->qty * $dp->harga_jual) }}</div>
                    </div>
                @endforeach
            @endif

            <div class="my-4 border-bottom border-dark"></div>

            <div class="row">
                <div class="col-6 text-center">Total</div>
                <div class="col-6 text-center">{{ rupiah($penjualan->total) }}</div>
            </div>
        </div>
        <a href="/penjualan" class="btn btn-danger btn-sm mt-4">Kembali</a>
    </div>
@endsection
