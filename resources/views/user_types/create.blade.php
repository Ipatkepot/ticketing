@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Tambah Usertype</h6>
        </div>
        <div class="card-body">
          <form action="{{ route('user_types.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nama Usertype</label>
              <input type="text" name="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('user_types.index') }}" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
