@extends('layouts.main')

@section('content')
    <x-alert />
    <div class="row text-end">
        <div class="col">
            <x-btn-add-data url="/reject/create" title="{{ $title }}" />
            <x-btn-switch-status url="/reject" title="{{ $title }}" />
        </div>
    </div>
    <x-table>
        <x-thead>
            <tr>
                <th>No</th>
                <th>Tanaman</th>
                <th>Qty</th>
                <th>Total</th>
                <th></th>
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
                        <td>{{ $r->tanaman ? $r->tanaman->nama : '' }}</td>
                        <td>{{ $r->qty }}</td>
                        <td>{{ $r->total }}</td>
                        <td>
                            @if ($r->status == 9)
                                <form action="/reject/{{ $r->id }}?actived=true" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/reject/{{ $r->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-edit me-1"></i>Ubah</a>
                                    <button class="btn btn-sm btn-success"><i class="fa fa-arrow-up me-1"></i>Aktifkan</button>
                                </form>
                            @else
                                <form action="/reject/{{ $r->id }}" method="POST" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/reject/{{ $r->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-edit me-1"></i>Ubah</a>
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
