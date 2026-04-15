@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4 shadow-sm">
        <div class="card-header pb-0 border-bottom d-flex justify-content-between align-items-center">
          <h6 class="mb-0 fw-bold">Manajemen User</h6>
          <form method="GET" action="{{ route('users.index') }}" style="width: 300px; max-width: 100%;">
              <div class="input-group input-group-sm">
                  <input 
                      type="text" 
                      name="search" 
                      value="{{ $search ?? '' }}"
                      class="form-control" 
                      placeholder="Cari user..."
                  >
                  <button class="btn btn-primary" type="submit">
                      <i class="fas fa-search"></i>
                  </button>
              </div>
          </form>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
          @if(session('success'))
            <div class="alert alert-success mx-4 mt-3">
              {{ session('success') }}
            </div>
          @endif

          <div class="table-responsive p-0">
            <table class="table table-hover align-items-center mb-0 text-center">
              <thead class="bg-light">
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Email</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Tipe User</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($users as $index => $user)
                  <tr style="font-size: 0.90rem;">
                    <td class="align-middle">{{ $users->firstItem() + $index }}</td>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">{{ ucfirst($user->usertype) }}</td>
                    <td class="align-middle">
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning me-2">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center text-muted py-4">Tidak ada user.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- Pagination --}}
          <div class="mt-4">
              {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
          </div>

          @push('styles')
          <style>
              .pagination {
                  justify-content: center;
              }
              .pagination .page-link {
                  color: #4e73df;
                  border-radius: 8px;
                  margin: 0 3px;
                  transition: all 0.2s ease-in-out;
              }
              .pagination .page-link:hover {
                  background-color: #4e73df;
                  color: white;
              }
              .pagination .active .page-link {
                  background-color: #4e73df;
                  border-color: #4e73df;
                  color: white;
              }
          </style>
          @endpush
@endsection
