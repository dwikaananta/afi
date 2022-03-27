@extends('layouts.main')

@section('content')
    <div class="vh-100 d-flex justify-content-center align-items-center bg-light" style="background-color: #98FB98 !important">
        <form action="/auth" method="POST" class="col-5 text-center p-3 bg-white">
            @csrf
            <h1 class="my-4">Login Sistem</h1>
            <x-alert />
            <x-input type="email" name="email" placeholder="Email" />
            <x-input type="password" name="password" placeholder="Password" />
            <button class="my-4 w-100 btn btn-primary rounded-pill">Login</button>
        </form>
    </div>
@endsection
