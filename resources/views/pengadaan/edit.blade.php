@extends('layouts.main')

@section('content')
    <form action="/pengadaan/{{ $pengadaan->id }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-4">
                <x-select label="Supplier" name="supplier_id">
                    <option value="">Pilih</option>
                    @foreach ($supplier as $s)
                        <option value="{{ $s->id }}" @if ($pengadaan->supplier_id == $s->id) selected @endif>{{ $s->nama }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-4">
                <x-input label="Tgl Pengadaan" name="tgl_pengadaan" type="date" value="{{ $pengadaan->tgl_pengadaan }}" />
            </div>
            <div class="col-4">
                <x-input label="Total" name="total" value="{{ $pengadaan->total }}" />
            </div>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-sm btn-success">Ubah</button>
            <a href="/pengadaan" class="btn btn-sm btn-danger">Kembali</a>
        </div>
    </form>
@endsection
