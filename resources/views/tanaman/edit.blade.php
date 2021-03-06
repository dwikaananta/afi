@extends('layouts.main')

@section('content')
    <form action="/tanaman/{{ $tanaman->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-6">
                <x-select label="Kategori" name="kategori">
                    <option value="">Pilih</option>
                    {{-- <option value="1" @if ($tanaman->kategori == 1) selected @endif>Palm plants</option> --}}
                    <option value="1" @if ($tanaman->kategori == 2) selected @endif>Aglaonema Plants</option>
                    <option value="2" @if ($tanaman->kategori == 3) selected @endif>Bonsai Plants</option>
                    <option value="3" @if ($tanaman->kategori == 4) selected @endif>Decorative Plants</option>
                    <option value="4" @if ($tanaman->kategori == 5) selected @endif>Greenery Plants</option>
                    <option value="5" @if ($tanaman->kategori == 6) selected @endif>Taro Plants</option>
                    <option value="6" @if ($tanaman->kategori == 7) selected @endif>Vines Plants</option>
                </x-select>
            </div>
            <div class="col-6">
                <x-input label="Nama Latin" name="nama_latin"
                    value="{{ count(explode('||', $tanaman->nama)) == 2 ? explode('||', $tanaman->nama)[0] : $tanaman->nama }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <x-input label="Harga Beli" name="harga_beli" value="{{ $tanaman->harga_beli }}" />
            </div>
            <div class="col-2">
                <x-input label="Harga Jual" name="harga_jual" value="{{ $tanaman->harga_jual }}" />
            </div>
            <div class="col-2">
                <x-input label="Stok" name="stok" value="{{ $tanaman->stok }}" />
            </div>
            <div class="col-6">
                <x-input label="Nama" name="nama"
                    value="{{ count(explode('||', $tanaman->nama)) == 2 ? explode('||', $tanaman->nama)[1] : $tanaman->nama }}" />
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="text-center">
                    <img src="/storage/tanaman/{{ $tanaman->img }}" alt="" class="img-fluid w-25">
                </div>
            </div>
            <div class="col-12">
                <x-input label="Foto" name="img" type="file" />
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success">Ubah</button>
        <a href="/tanaman" class="btn btn-sm btn-danger">Kembali</a>
    </form>
@endsection
