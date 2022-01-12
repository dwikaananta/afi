@extends('layouts.main')

@section('content')
    <form action="/supplier" method="POST">
        @csrf
        <div class="row">
            <div class="col-4">
                <x-input label="Nama" name="nama" />
            </div>
            <div class="col-4">
                <x-input label="Email" name="email" />
            </div>
            <div class="col-4">
                <x-input label="No Tlp" name="no_tlp" />
            </div>
        </div>
        <x-textarea label="Alamat" name="alamat" />
        <div class="btn-group">
            <button type="submit" class="btn btn-sm btn-success">Tambah</button>
            <a href="/supplier" class="btn btn-sm btn-danger">Kembali</a>
        </div>
    </form>
@endsection
