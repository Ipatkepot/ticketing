@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="mb-2">Selamat Datang, {{ auth()->user()->name }}</h4>
                    <p class="text-muted mb-0">
                        Anda login sebagai <strong>{{ ucfirst(auth()->user()->usertype) }}</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
