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
                    <th>Total (Rp)</th>
                    {{-- <th>Aksi</th> --}}
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
                            <td>
                                @php
                                    if ($r->tanaman) {
                                        $nama = explode('||', $r->tanaman->nama);
                                        if (count($nama) == 2) {
                                            echo $nama[0] . '<br /> (' . $nama[1] . ')';
                                        } else {
                                            echo $r->tanaman->nama;
                                        }
                                    }
                                @endphp
                            </td>
                            <td class="text-center">{{ $r->qty }}</td>
                            <td class="text-center">{{ $r->tgl_reject ? date('d-m-Y', strtotime($r->tgl_reject)) : '' }}</td>
                            <td class="text-end">{{ rupiah($r->total) }}</td>
                            {{-- <td class="text-center">
                                <a href="/reject-detail/{{ $r->id }}">Detail</a>
                            </td> --}}
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <x-btn-print />
    </div>
@endsection
