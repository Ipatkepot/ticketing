@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Daftar Kategori Tiket</h6>
          <a href="{{ route('ticket_categories.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
          </a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 text-center">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle">Nama Kategori</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($ticket_categories as $category)
                <tr>
                  <td class="align-middle">
                    <span class="text-sm">{{ $category->name }}</span>
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
                  <td colspan="2" class="text-center text-muted py-4">
                    Belum ada kategori.
                  </td>
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
