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
                <th>Nama</th>
                <th>Foto</th>
                {{-- <th>Gender</th> --}}
                <th>No Tlp</th>
                <th>Email</th>
                <th>Alamat</th>
                {{-- <th>Reg Date</th> --}}
                <th>Aksi</th>
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
                        <td class="text-nowrap">{{ $u->nama }}</td>
                        <td class="text-center" style="width: 10%">
                            <img src="/storage/users/{{ $u->img }}" class="img-fluid" alt="">
                        </td>
                        {{-- <td class="text-nowrap">{{ $u->gender == 1 ? 'Laki-Laki' : 'Perempuan' }}</td> --}}
                        <td class="text-nowrap text-center">{{ $u->no_tlp }}</td>
                        <td class="text-nowrap">{{ $u->email }}</td>
                        <td class="text-nowrap">{{ $u->alamat }}</td>
                        {{-- <td class="text-nowrap">{{ $u->regdate ? date('d-m-Y', strtotime($u->regdate)) : '' }}</td> --}}
                        <td>
                            @if ($u->status == 9)
                                <form action="/user/{{ $u->id }}?actived=true" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/user/{{ $u->id }}/edit" class="btn btn-sm btn-success"><i
                                            class="fa fa-edit me-1"></i></a>
                                    <button class="btn btn-sm btn-primary"><i
                                            class="fa fa-power-off me-1"></i></button>
                                </form>
                            @else
                                <form action="/user/{{ $u->id }}" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/user/{{ $u->id }}/edit" class="btn btn-sm btn-success"><i
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
