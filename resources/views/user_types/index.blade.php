@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Daftar Usertype</h6>
          <a href="{{ route('user_types.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Usertype
          </a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 text-center">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle">Nama Usertype</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($user_types as $usrtyp)
                <tr>
                  <td class="align-middle">
                    <span class="text-sm">{{ $usrtyp->name }}</span>
                  </td>
                  <td class="align-middle">
                    <a href="{{ route('user_types.edit', $usrtyp->id) }}" class="btn btn-sm btn-warning me-2">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('user_types.destroy', $usrtyp->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    Belum ada Usertype.
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
