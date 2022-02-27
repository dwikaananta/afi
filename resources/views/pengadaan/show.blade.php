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
                    : {{ $pengadaan->nota_pengadaan }}
                </div>
            </div>

            <div class="my-4 border-bottom border-dark"></div>

            @if ($pengadaan->detail_pengadaan)
                @foreach ($pengadaan->detail_pengadaan as $dp)
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
                        <div class="col-3 text-center">{{ rupiah($dp->harga_beli) }}</div>
                        <div class="col-3 text-end pe-4">{{ rupiah($dp->qty * $dp->harga_beli) }}</div>
                    </div>
                @endforeach
            @endif

            <div class="my-4 border-bottom border-dark"></div>

            <div class="row">
                <div class="col-6 text-center">Total</div>
                <div class="col-6 text-center">{{ rupiah($pengadaan->total) }}</div>
            </div>
        </div>
        <a href="/pengadaan" class="btn btn-danger btn-sm mt-4">Kembali</a>
    </div>
@endsection
