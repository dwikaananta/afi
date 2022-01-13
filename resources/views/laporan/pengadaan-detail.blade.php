@extends('layouts.print')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>Detail Pengadaan</h1>
        </div>

        <div class="border border-dark py-3">
            <div class="row">
                <div class="col-6 text-end">
                    User
                </div>
                <div class="col-6 text-start">
                    {{ $pengadaan->user ? $pengadaan->user->nama : '' }}
                </div>
                <div class="col-6 text-end">
                    Supplier
                </div>
                <div class="col-6 text-start">
                    {{ $pengadaan->supplier ? $pengadaan->supplier->nama : '' }}
                </div>
                <div class="col-6 text-end">
                    Tgl Pengadaan
                </div>
                <div class="col-6 text-start">
                    {{ date('d-m-Y', strtotime($pengadaan->tgl_penjualan)) }}
                </div>
                <div class="col-6 text-end">
                    Nota Pengadaan
                </div>
                <div class="col-6 text-start">
                    {{ $pengadaan->kode_penjualan }}
                </div>
            </div>

            <div class="my-4 border-bottom border-dark"></div>

            @if ($pengadaan->detail_pengadaan)
                <table class="w-100">
                    @foreach ($pengadaan->detail_pengadaan as $dp)
                        <tr>
                            <td class="text-center">{{ $dp->tanaman ? $dp->tanaman->nama : '' }}</td>
                            <td class="text-center">{{ $dp->qty }} PCS</td>
                            <td class="text-center">Rp {{ $dp->harga_beli }}</td>
                            <td class="text-center">Rp {{ $dp->qty * $dp->harga_beli }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif

            <div class="my-4 border-bottom border-dark"></div>

            <div class="row">
                <div class="col-6 text-center">Total</div>
                <div class="col-6 text-center">{{ $pengadaan->total }}</div>
            </div>
        </div>

        <x-btn-print />
    </div>
@endsection