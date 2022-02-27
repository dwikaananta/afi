@extends('layouts.main')

@include('layouts.helper')

@section('content')
    <div class="row mt-5">
        <div class="col-6 d-flex align-items-end">
            <x-pil-bul-tah />
        </div>
    </div>
    <x-table>
        <x-thead>
            <tr>
                <th>No</th>
                <th>Tanaman</th>
                <th>Qty</th>
                <th>Tanggal Reject</th>
                <th>Total (Rp)</th>
                <th>Aksi</th>
            </tr>
        </x-thead>
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
                        <td class="text-center">
                            <a href="/reject-detail/{{ $r->id }}">Detail</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </x-table>

    <div class="text-center">
        @if (isset($_GET['bulan']) && $_GET['bulan'] != '' && isset($_GET['tahun']) && $_GET['tahun'] != '')
            <a href="/laporan-reject-print?bulan={{ $_GET['bulan'] }}&tahun={{ $_GET['tahun'] }}" class="btn btn-info text-white">Print</a>
        @endif
    </div>
@endsection
