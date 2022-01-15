@extends('layouts.main')

@section('content')
    <form action="/tanaman" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-4">
                <x-select label="Kategori" name="kategori">
                    <option value="">Pilih</option>
                    {{-- <option value="1">Palm plants</option> --}}
                    <option value="2">Aglaonema Plants</option>
                    <option value="3">Bonsai Plants</option>
                    <option value="4">Decorative Plants</option>
                    <option value="5">Greenery Plants</option>
                    <option value="6">Taro Plants</option>
                    <option value="7">Vines Plants</option>
                </x-select>
            </div>
            <div class="col-4">
                <x-input label="Nama" name="nama" />
            </div>
            <div class="col-4">
                <x-input label="Foto" name="img" type="file" />
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <x-input label="Harga Beli" name="harga_beli" />
            </div>
            <div class="col-4">
                <x-input label="Harga Jual" name="harga_jual" />
            </div>
            <div class="col-4">
                <x-input label="Stok" name="stok" />
            </div>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-sm btn-success">Tambah</button>
            <a href="/tanaman" class="btn btn-sm btn-danger">Kembali</a>
        </div>
    </form>
@endsection
