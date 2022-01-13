@extends('layouts.main')

@section('content')
    <x-table>
        <x-thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Supplier</th>
                <th>Tgl Pengadaan</th>
                <th>Nota Pengadaan</th>
                <th>Total</th>
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
                        <td>{{ $p->tgl_pengadaan }}</td>
                        <td>{{ $p->kode_pengadaan }}</td>
                        <td>{{ $p->total }}</td>
                        <td>
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
@endsection
