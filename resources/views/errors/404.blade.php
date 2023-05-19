@extends('layouts.main')
@section('title', 'Page Not Found')

@section('content')
    <img src="{{ asset('assets/static/errors/404.png') }}">
    <p class="text-center fs-1">الصفحة التي ترغب بزيارتها غير متوفرة</p>
@endsection
