@extends('layouts.print')

@include('layouts.helper')

@section('content')
    <div class="container">
        <h3 class="text-center">Laporan Reject {{ getBulan($_GET['bulan']) }} {{ $_GET['tahun'] }}</h3>

        <table class="table">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Tanaman</th>
                    <th>Qty</th>
                    <th>Tanggal Reject</th>
                    <th class="text-end">Total (Rp)</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody>
                @foreach ($reject as $r)
                    @if ($r->status == isset($_GET['deleted']))
                        <tr>
                            <td class="text-center">{{ $no ++ }}</td>
                            <td>{{ $r->tanaman ? $r->tanaman->nama : '' }}</td>
                            <td>{{ $r->qty }}</td>
                            <td>{{ $r->tgl_reject ? date('d-m-Y', strtotime($r->tgl_reject)) : '' }}</td>
                            <td class="text-end">{{ rupiah($r->total) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <x-btn-print />
    </div>
@endsection
