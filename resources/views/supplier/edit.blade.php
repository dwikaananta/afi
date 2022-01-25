@extends('layouts.main')

@section('content')
    <form action="/supplier/{{ $supplier->id }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-4">
                <x-input label="Nama" name="nama" value="{{ $supplier->nama }}" />
            </div>
            <div class="col-4">
                <x-input label="Email" name="email" value="{{ $supplier->email }}" />
            </div>
            <div class="col-4">
                <x-input label="No Tlp" name="no_tlp" value="{{ $supplier->no_tlp }}" />
            </div>
        </div>
        <x-textarea label="Alamat" name="alamat" value="{{ $supplier->alamat }}" />
        <button type="submit" class="btn btn-sm btn-success">Ubah</button>
        <a href="/supplier" class="btn btn-sm btn-danger">Kembali</a>
    </form>
@endsection
