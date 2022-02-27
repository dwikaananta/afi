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
                <th>User</th>
                <th>Tgl Penjualan</th>
                <th>Nota Penjualan</th>
                <th>Nama Customer</th>
                <th>No Telp</th>
                <th>Total (Rp)</th>
                <th>Aksi</th>
                {{-- <th></th> --}}
            </tr>
        </x-thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($penjualan as $p)
                @if ($p->status == isset($_GET['deleted']))
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $p->user ? $p->user->nama : '' }}</td>
                        <td class="text-center">{{ $p->tgl_penjualan }}</td>
                        <td class="text-center">{{ $p->nota_penjualan }}</td>
                        <td>{{ $p->nama }}</td>
                        <td class="text-center">{{ $p->no_tlp }}</td>
                        <td class="text-end">{{ rupiah($p->total) }}</td>
                        <td class="text-center">
                            <a href="/penjualan-detail/{{ $p->id }}">Detail</a>
                        </td>
                        {{-- <td>
                        @if ($p->status == 9)
                            <form action="/pengadaan/{{ $p->id }}?actived=true" method="POST"
                                class="text-center">
                                @csrf
                                @method('DELETE')
                                <a href="/pengadaan/{{ $p->id }}/edit" class="btn btn-sm btn-success"><i
                                        class="fa fa-edit me-1"></i>Ubah</a>
                                <button class="btn btn-sm btn-success"><i
                                        class="fa fa-arrow-up me-1"></i>Aktifkan</button>
                            </form>
                        @else
                            <form action="/pengadaan/{{ $p->id }}" method="POST" class="text-center">
                                @csrf
                                @method('DELETE')
                                <a href="/pengadaan/{{ $p->id }}/edit" class="btn btn-sm btn-success"><i
                                        class="fa fa-edit me-1"></i>Ubah</a>
                                <button class="btn btn-sm btn-danger"><i class="fa fa-arrow-down me-1"></i>Nonaktifkan</button>
                            </form>
                        @endif
                    </td> --}}
                    </tr>
                @endif
            @endforeach
        </tbody>
    </x-table>

    <div class="text-center">
        @if (isset($_GET['bulan']) && $_GET['bulan'] != '' && isset($_GET['tahun']) && $_GET['tahun'] != '')
            <a href="/laporan-penjualan-print?bulan={{ $_GET['bulan'] }}&tahun={{ $_GET['tahun'] }}" class="btn btn-info text-white">Print</a>
        @endif
    </div>
@endsection
