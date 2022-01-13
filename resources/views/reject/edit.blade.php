@extends('layouts.main')

@section('content')
    <form action="/reject/{{ $reject->id }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-2">
            <div class="col-6">
                <x-select label="Tanaman" name="tanaman_id">
                    <option value="">Pilih</option>
                    @foreach ($tanaman as $t)
                        <option value="{{ $t->id }}" @if ($reject->tanaman_id == $t->id) selected @endif>{{ $t->nama }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-6">
                <x-input label="Qty" name="qty" type="number" value="{{ $reject->qty }}" />
            </div>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-sm btn-success">Ubah</button>
            <a href="/reject" class="btn btn-sm btn-danger">Kembali</a>
        </div>
    </form>
@endsection
