@extends('layouts.main')

@section('content')
    <form action="/user/{{ $user->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <x-input label="Nama" name="nama" type="text" value="{{ $user->nama }}" />
        <div class="row">
            <div class="col-md-4">
                <p class="mb-2">Jenis Kelamin</p>
                <x-radio label="Laki-Laki" name="gender" value="1" inline="{{ true }}"
                    checked="{{ $user->gender }}" />
                <x-radio label="Perempuan" name="gender" value="2" inline="{{ true }}"
                    checked="{{ $user->gender }}" />
            </div>
            <div class="col-md-4">
                <x-input label="No Tlp" name="no_tlp" type="text" value="{{ $user->no_tlp }}" />
            </div>
            <div class="col-md-4">
                <x-input label="Email" name="email" type="text" value="{{ $user->email }}" />
            </div>
        </div>
        <x-textarea label="Alamat" name="alamat" value="{{ $user->alamat }}" />
        <div class="row">
            <div class="col-6">
                <x-input label="Password" name="password" type="password" />
            </div>
            <div class="col-6">
                <x-input label="Konfirmasi Password" name="password_confirmation" type="password" />
            </div>
        </div>
        <div class="text-center">
            <img src="/storage/users/{{ $user->img }}" alt="" class="img-fluid w-25">
        </div>
        <x-input label="Foto" name="img" type="file" />
        <div class="btn-group">
            <button type="submit" class="btn btn-sm btn-success">Ubah</button>
            <a href="/user" class="btn btn-sm btn-danger">Kembali</a>
        </div>
    </form>
@endsection
