@extends('layouts.main')

@section('content')
    <form action="/reject" method="POST">
        @csrf

        @php
            function getDetail($t_nama) {
                $nama = explode('||', $t_nama);
                if (count($nama) == 2) {
                    echo $nama[0] . ' (' . $nama[1] . ')';
                } else {
                    echo $t_nama;
                }
            }
        @endphp

        <div class="row mb-2">
            <div class="col-6">
                <x-select label="Tanaman" name="tanaman_id">
                    <option value="">Pilih</option>
                    @foreach ($tanaman as $t)
                        <option value="{{ $t->id }}">{{ $t->kode }} {{ getDetail($t->nama) }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-6">
                <x-input label="Qty" name="qty" type="number" />
            </div>
            <div class="col-12">
                <x-input label="Tgl Reject" name="tgl_reject" type="date" />
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success">Tambah</button>
        <a href="/reject" class="btn btn-sm btn-danger">Kembali</a>
    </form>
@endsection
