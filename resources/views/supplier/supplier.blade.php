@extends('layouts.main')

@section('content')
    <x-alert />
    <div class="row text-end">
        <div class="col">
            <x-btn-add-data url="/supplier/create" title="{{ $title }}" />
            <x-btn-switch-status url="/supplier" title="{{ $title }}" />
        </div>
    </div>
    <x-table>
        <x-thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Tlp</th>
                <th>Alamat</th>
                <th></th>
            </tr>
        </x-thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($supplier as $s)
                @if ($s->status == isset($_GET['deleted']))
                    <tr>
                        <td class="text-center">{{ $no ++ }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->email }}</td>
                        <td>{{ $s->no_tlp }}</td>
                        <td>{{ $s->alamat }}</td>
                        <td>
                            @if ($s->status == 9)
                                <form action="/supplier/{{ $s->id }}?actived=true" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/supplier/{{ $s->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-edit me-1"></i>Ubah</a>
                                    <button class="btn btn-sm btn-success"><i class="fa fa-arrow-up me-1"></i>Aktifkan</button>
                                </form>
                            @else
                                <form action="/supplier/{{ $s->id }}" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/supplier/{{ $s->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-edit me-1"></i>Ubah</a>
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-arrow-down me-1"></i>Nonaktifkan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </x-table>

@endsection
