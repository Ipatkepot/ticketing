@extends('layouts.app')

@section('content')
    <div class="card p-4">
        <h4>Halo, {{ Auth::user()->name }}</h4>
        <p>Selamat datang di dashboard user!</p>
    </div>
@endsection
