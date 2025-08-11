@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Import Data User</h5>
        </div>

        <div class="card-body">
          {{-- Notifikasi sukses --}}
          @if(session('success'))
            <div class="alert alert-success">
              <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            </div>
          @endif

          {{-- Form upload --}}
          <form action="{{ route('admin.users.import.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="file" class="form-label fw-semibold">Upload File (.xlsx, .xls, .csv)</label>
              <input type="file" name="file" id="file" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">
              <i class="fas fa-upload me-1"></i> Import
            </button>
          </form>
        </div>
      </div>

      <div class="card mt-4 border-0 shadow-sm">
        <div class="card-body">
          <div class="alert alert-secondary mb-0 small">
            <strong>Format file:</strong><br>
            Baris pertama harus berisi header: <code>name</code>, <code>email</code>, <code>password</code>, <code>usertype</code><br>
            Contoh usertype: <code>admin</code>, <code>staff</code>, <code>mahasiswa</code>, <code>ketuap3ti</code>, <code>pimpinan</code>, dll.
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
