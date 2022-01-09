@extends('layouts.main')

@section('content')
    <h3 class="py-3">{{ $title ?? '' }}</h3>
    <x-alert />
@endsection
