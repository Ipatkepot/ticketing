@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Edit User</h6>
        </div>
        <div class="card-body px-4">
          <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" value="{{ $user->name }}" disabled>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            <div class="mb-3">
              <label class="form-label">Tipe User</label>
              <select name="usertype" class="form-control" required>
                @foreach ($userTypes as $type)
                  <option value="{{ $type->name }}" {{ $user->usertype === $type->name ? 'selected' : '' }}>{{ ucfirst($type->name) }}</option>
                @endforeach
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
