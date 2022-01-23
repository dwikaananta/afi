@extends('layouts.main')

@include('layouts.helper')

@section('content')
    <x-alert />
    <div class="row text-end">
        <div class="col">
            <x-btn-add-data url="/tanaman/create" title="{{ $title }}" />
            <x-btn-switch-status url="/tanaman" title="{{ $title }}" />
        </div>
    </div>
    <x-table>
        <x-thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Kode</th>
                <th>Nama</th>
                <th class="text-end">Harga Beli (Rp)</th>
                <th class="text-end">Harga Jual (Rp)</th>
                <th>Stok</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </x-thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($tanaman as $t)
                @if ($t->status == isset($_GET['deleted']))
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>
                            {{-- {{ $t->kategori == 1 ? 'Palm plants' : '' }} --}}
                            {{ $t->kategori == 1 ? 'Aglaonema Plants' : '' }}
                            {{ $t->kategori == 2 ? 'Bonsai Plants' : '' }}
                            {{ $t->kategori == 3 ? 'Decorative Plants' : '' }}
                            {{ $t->kategori == 4 ? 'Greenery Plants' : '' }}
                            {{ $t->kategori == 5 ? 'Taro Plants' : '' }}
                            {{ $t->kategori == 6 ? 'Vines Plants' : '' }}
                        </td>
                        <td>{{ $t->kode }}</td>
                        <td>{{ $t->nama }}</td>
                        <td class="text-end">{{ rupiah($t->harga_beli) }}</td>
                        <td class="text-end">{{ rupiah($t->harga_jual) }}</td>
                        <td class="text-center">{{ $t->stok }}</td>
                        <td class="text-center" style="width: 10%">
                            <img src="/storage/tanaman/{{ $t->img }}" class="img-fluid" alt="">
                        </td>
                        <td class="text-nowrap">
                            @if ($t->status == 9)
                                <form action="/tanaman/{{ $t->id }}?actived=true" method="POST"
                                    class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/tanaman/{{ $t->id }}/edit" class="btn btn-sm btn-success"><i
                                            class="fa fa-edit me-1"></i></a>
                                    <button class="btn btn-sm btn-success"><i
                                            class="fa fa-arrow-up me-1"></i></button>
                                </form>
                            @else
                                <form action="/tanaman/{{ $t->id }}" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/tanaman/{{ $t->id }}/edit" class="btn btn-sm btn-success"><i
                                            class="fa fa-edit me-1"></i></a>
                                    <button class="btn btn-sm btn-danger"><i
                                            class="fa fa-power-off me-1"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </x-table>
@endsection
