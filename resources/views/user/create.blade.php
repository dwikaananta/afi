@extends('layouts.main')

@section('content')
    <form action="/user" method="POST">
        @csrf
        <x-input label="Foto" name="img" type="file" />
        <x-input label="Nama" name="nama" type="text" />
        <div class="row">
            <div class="col-md-4">
                <p class="mb-2">Jenis Kelamin</p>
                <x-radio label="Laki-Laki" name="gender" value="1" inline="{{ true }}" />
                <x-radio label="Perempuan" name="gender" value="0" inline="{{ true }}" />
            </div>
            <div class="col-md-4">
                <x-input label="No Tlp" name="no_tlp" type="text" />
            </div>
            <div class="col-md-4">
                <x-input label="Email" name="email" type="text" />
            </div>
        </div>
        <x-textarea label="Alamat" name="alamat" />
        <div class="row">
            <div class="col-6">
                <x-input label="Password" name="password" type="password" />
            </div>
            <div class="col-6">
                <x-input label="Konfirmasi Password" name="password_confirmation" type="password" />
            </div>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            <a href="/user" class="btn btn-sm btn-danger">Kembali</a>
        </div>
    </form>
@endsection
