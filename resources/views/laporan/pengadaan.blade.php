@extends('layouts.main')

@include('layouts.helper')

@section('content')
    <div class="row">
        <div class="col-6 d-flex align-items-end">
            <form action="" class="mb-3 w-100 d-flex" method="GET">
                <select class="form-select me-3" name="bulan">
                    <option value="">Pilih Bulan</option>
                    <option value="1" @if(isset($_GET['bulan']) && $_GET['bulan'] == 1) selected @endisset>Jan</option>
                    <option value="2" @if(isset($_GET['bulan']) && $_GET['bulan'] == 2) selected @endisset>Feb</option>
                    <option value="3" @if(isset($_GET['bulan']) && $_GET['bulan'] == 3) selected @endisset>Mar</option>
                    <option value="4" @if(isset($_GET['bulan']) && $_GET['bulan'] == 4) selected @endisset>Apr</option>
                    <option value="5" @if(isset($_GET['bulan']) && $_GET['bulan'] == 5) selected @endisset>Mei</option>
                    <option value="6" @if(isset($_GET['bulan']) && $_GET['bulan'] == 6) selected @endisset>Jun</option>
                    <option value="7" @if(isset($_GET['bulan']) && $_GET['bulan'] == 7) selected @endisset>Jul</option>
                    <option value="8" @if(isset($_GET['bulan']) && $_GET['bulan'] == 8) selected @endisset>Agt</option>
                    <option value="9" @if(isset($_GET['bulan']) && $_GET['bulan'] == 9) selected @endisset>Sep</option>
                    <option value="10" @if(isset($_GET['bulan']) && $_GET['bulan'] == 10) selected @endisset>Okt</option>
                    <option value="11" @if(isset($_GET['bulan']) && $_GET['bulan'] == 11) selected @endisset>Nov</option>
                    <option value="12" @if(isset($_GET['bulan']) && $_GET['bulan'] == 12) selected @endisset>Des</option>
                </select>
        
                <select class="form-select me-3" name="tahun">
                    <option value="">Pilih Tahun</option>
                    <option value="2020" @if(isset($_GET['tahun']) && $_GET['tahun'] == 2020) selected @endif>2020</option>
                    <option value="2021" @if(isset($_GET['tahun']) && $_GET['tahun'] == 2021) selected @endif>2021</option>
                    <option value="2022" @if(isset($_GET['tahun']) && $_GET['tahun'] == 2022) selected @endif>2022</option>
                </select>
        
                <button class="btn btn-sm btn-info text-white">Pilih</button>
            </form>
        </div>
    </div>
    <x-table>
        <x-thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Supplier</th>
                <th>Tgl Pengadaan</th>
                <th>Nota Pengadaan</th>
                <th>Total (Rp)</th>
                <th>Aksi</th>
                {{-- <th></th> --}}
            </tr>
        </x-thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($pengadaan as $p)
                @if ($p->status == isset($_GET['deleted']))
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $p->user ? $p->user->nama : '' }}</td>
                        <td>{{ $p->supplier ? $p->supplier->nama : '' }}</td>
                        <td class="text-center">{{ $p->tgl_pengadaan }}</td>
                        <td class="text-center">{{ $p->nota_pengadaan }}</td>
                        <td class="text-end">{{ rupiah($p->total) }}</td>
                        <td class="text-center">
                            <a href="/pengadaan-detail/{{ $p->id }}">Detail</a>
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
            <a href="/laporan-pengadaan-print?bulan={{ $_GET['bulan'] }}&tahun={{ $_GET['tahun'] }}" class="btn btn-info text-white">Print</a>
        @endif
    </div>
@endsection
