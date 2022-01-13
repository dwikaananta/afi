@extends('layouts.main')

@section('content')
    <form action="/reject" method="POST">
        @csrf
        <div class="row mb-2">
            <div class="col-6">
                <x-select label="Tanaman" name="tanaman_id">
                    <option value="">Pilih</option>
                    @foreach ($tanaman as $t)
                        <option value="{{ $t->id }}">{{ $t->nama }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-6">
                <x-input label="Qty" name="qty" type="number" />
            </div>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-sm btn-success">Tambah</button>
            <a href="/reject" class="btn btn-sm btn-danger">Kembali</a>
        </div>
    </form>
@endsection
