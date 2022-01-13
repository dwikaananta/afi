@extends('layouts.main')

@section('content')
    <x-alert />
    <div class="row text-end">
        <div class="col">
            <x-btn-add-data url="/penjualan/create" title="{{ $title }}" />
            {{-- <x-btn-switch-status url="/penjualan" title="{{ $title }}" /> --}}
        </div>
    </div>
    <x-table>
        <x-thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Tgl Penjualan</th>
                <th>Kode Penjualan</th>
                <th>Nama</th>
                <th>No Tlp</th>
                <th>Total</th>
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
                        <td class="text-center">{{ $no ++ }}</td>
                        <td>{{ $p->user ? $p->user->nama : '' }}</td>
                        <td>{{ $p->tgl_penjualan }}</td>
                        <td>{{ $p->kode_penjualan }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->no_tlp }}</td>
                        <td>{{ $p->total }}</td>
                        {{-- <td>
                            @if ($p->status == 9)
                                <form action="/penjualan/{{ $p->id }}?actived=true" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/penjualan/{{ $p->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-edit me-1"></i>Ubah</a>
                                    <button class="btn btn-sm btn-success"><i class="fa fa-arrow-up me-1"></i>Aktifkan</button>
                                </form>
                            @else
                                <form action="/penjualan/{{ $p->id }}" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/penjualan/{{ $p->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-edit me-1"></i>Ubah</a>
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-arrow-down me-1"></i>Nonaktifkan</button>
                                </form>
                            @endif
                        </td> --}}
                    </tr>
                @endif
            @endforeach
        </tbody>
    </x-table>

@endsection
