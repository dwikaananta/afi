@extends('layouts.main')

@section('content')
    <div class="row text-end">
        <div class="col">
            <a href="/user/create" class="btn btn-primary mb-2">Tambah User</a>
        </div>
    </div>
    <x-user-index />
@endsection