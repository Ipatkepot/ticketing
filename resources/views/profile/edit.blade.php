@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-4">Pengaturan Akun</h4>

    <div class="row">
        {{-- Informasi Profil --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <strong>Informasi Profil</strong>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        {{-- Ubah Password --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning text-white">
                    <strong>Ubah Password</strong>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        {{-- Hapus Akun --}}
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <strong>Hapus Akun</strong>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
