@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mb-0">Manajemen User</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          @if(session('success'))
            <div class="alert alert-success mx-4 mt-3">
              {{ session('success') }}
            </div>
          @endif
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 text-center">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Email</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Tipe User</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($users as $user)
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->usertype) }}</td>
                    <td>
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning me-2">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                          <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center text-muted py-4">Tidak ada user.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
