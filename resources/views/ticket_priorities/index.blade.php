@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4 shadow-sm">
        <div class="card-header pb-0 border-bottom d-flex justify-content-between align-items-center">
          <h6 class="mb-0 fw-bold">Daftar Prioritas Tiket</h6>
          <a href="{{ route('ticket_priorities.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Prioritas
          </a>
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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama Prioritas</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($ticket_priorities as $index => $priority)
                  <tr style="font-size: 0.90rem;">
                    <td class="align-middle">
                      {{ $ticket_priorities->firstItem() + $index }}
                    </td>
                    <td class="align-middle">{{ $priority->name }}</td>
                    <td class="align-middle">
                      <a href="{{ route('ticket_priorities.edit', $priority->id) }}" class="btn btn-sm btn-warning me-2">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <form action="{{ route('ticket_priorities.destroy', $priority->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                          <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center text-muted py-4">Belum ada prioritas.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          {{-- Pagination --}}
          <div class="d-flex justify-content-end mt-3 me-3">
              {{ $ticket_priorities->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
