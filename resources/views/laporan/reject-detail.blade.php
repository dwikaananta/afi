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
            <h1>Detail Reject</h1>
        </div>

        <div class="border border-dark py-3">
            <div class="row">
                <div class="col-3 ps-4">
                    Tgl reject
                </div>
                <div class="col-9">
                    : {{ date('d-m-Y', strtotime($reject->tgl_reject)) }}
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

            <div class="row">
                <div class="col ps-4">{{ $reject->tanaman ? getDetail($reject->tanaman->nama) : '' }}</div>
                <div class="col text-center">{{ $reject->qty }} PCS</div>
                <div class="col text-center">{{ $reject->tanaman ? rupiah($reject->tanaman->harga_beli) : '' }}</div>
                <div class="col text-end pe-4">{{ $reject->tanaman ? rupiah($reject->tanaman->harga_jual) : '' }}</div>
            </div>

            <div class="my-4 border-bottom border-dark"></div>

            <div class="row">
                <div class="col-6 text-center">Total</div>
                <div class="col-6 text-center">{{ rupiah($reject->total) }}</div>
            </div>
        </div>

        <x-btn-print />
    </div>
@endsection
