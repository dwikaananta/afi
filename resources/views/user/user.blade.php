@extends('layouts.main')

@section('content')
    <x-alert />
    <div class="row text-end">
        <div class="col">
            <x-btn-add-data url="/user/create" title="{{ $title }}" />
            <x-btn-switch-status url="/user" title="{{ $title }}" />
        </div>
    </div>
    <x-table>
        <x-thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>No Tlp</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Reg Date</th>
                <th></th>
            </tr>
        </x-thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($user as $u)
                @if ($u->status == isset($_GET['deleted']))
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center" style="width: 10%">
                            <img src="/storage/tanaman/{{ $u->img }}" class="img-fluid" alt="">
                        </td>
                        <td>{{ $u->nama }}</td>
                        <td>{{ $u->gender == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>
                        <td>{{ $u->no_tlp }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->alamat }}</td>
                        <td>{{ $u->regdate ? date('d-m-Y', strtotime($u->regdate)) : '' }}</td>
                        <td>
                            @if ($u->status == 9)
                                <form action="/user/{{ $u->id }}?actived=true" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/user/{{ $u->id }}/edit" class="btn btn-sm btn-success"><i
                                            class="fa fa-edit me-1"></i>Ubah</a>
                                    <button class="btn btn-sm btn-success"><i
                                            class="fa fa-arrow-up me-1"></i>Aktifkan</button>
                                </form>
                            @else
                                <form action="/user/{{ $u->id }}" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/user/{{ $u->id }}/edit" class="btn btn-sm btn-success"><i
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
