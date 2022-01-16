@extends('layouts.main')

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
                <th>Nama</th>
                <th class="text-end">Harga Beli (Rp)</th>
                <th class="text-end">Harga Jual (Rp)</th>
                <th>Stok</th>
                <th>Foto</th>
                <th></th>
            </tr>
        </x-thead>
        @php
            $no = 1;
            
            function rupiah($angka)
            {
                $hasil_rupiah = number_format($angka, 2, ',', '.');
                return $hasil_rupiah;
            }
        @endphp
        <tbody>
            @foreach ($tanaman as $t)
                @if ($t->status == isset($_GET['deleted']))
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>
                            {{-- {{ $t->kategori == 1 ? 'Palm plants' : '' }} --}}
                            {{ $t->kategori == 2 ? 'Aglaonema Plants' : '' }}
                            {{ $t->kategori == 3 ? 'Bonsai Plants' : '' }}
                            {{ $t->kategori == 4 ? 'Decorative Plants' : '' }}
                            {{ $t->kategori == 5 ? 'Greenery Plants' : '' }}
                            {{ $t->kategori == 6 ? 'Taro Plants' : '' }}
                            {{ $t->kategori == 7 ? 'Vines Plants' : '' }}
                        </td>
                        <td>{{ $t->nama }}</td>
                        <td class="text-end">{{ rupiah($t->harga_beli) }}</td>
                        <td class="text-end">{{ rupiah($t->harga_jual) }}</td>
                        <td>{{ $t->stok }}</td>
                        <td class="text-center" style="width: 10%">
                            <img src="/storage/tanaman/{{ $t->img }}" class="img-fluid" alt="">
                        </td>
                        <td>
                            @if ($t->status == 9)
                                <form action="/tanaman/{{ $t->id }}?actived=true" method="POST"
                                    class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/tanaman/{{ $t->id }}/edit" class="btn btn-sm btn-success"><i
                                            class="fa fa-edit me-1"></i>Ubah</a>
                                    <button class="btn btn-sm btn-success"><i
                                            class="fa fa-arrow-up me-1"></i>Aktifkan</button>
                                </form>
                            @else
                                <form action="/tanaman/{{ $t->id }}" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/tanaman/{{ $t->id }}/edit" class="btn btn-sm btn-success"><i
                                            class="fa fa-edit me-1"></i>Ubah</a>
                                    <button class="btn btn-sm btn-danger"><i
                                            class="fa fa-arrow-down me-1"></i>Nonaktifkan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </x-table>
@endsection
