@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4 shadow-sm">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6 class="mb-0 fw-bold">Daftar Kategori Tiket</h6>
          <a href="{{ route('ticket_categories.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
          </a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table table-hover align-items-center mb-0 text-center">
              <thead class="bg-light">
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle">Nama Kategori</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($ticket_categories as $index => $category)
                <tr style="font-size: 0.9rem;">
                  <td class="align-middle">{{ $ticket_categories->firstItem() + $index }}</td>
                  <td class="align-middle">
                    {{ $category->name }}
                  </td>
                  <td class="align-middle">
                    <a href="{{ route('ticket_categories.edit', $category->id) }}" class="btn btn-sm btn-warning me-2">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('ticket_categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                  <td colspan="3" class="text-center text-muted py-4">
                    Belum ada kategori.
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- Pagination --}}
          <div class="mt-4">
              {{ $ticket_categories->onEachSide(1)->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
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
