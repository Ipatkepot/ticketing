@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card">
        <div class="card-header pb-0">
          <h6>Buat Tiket Keluhan</h6>
        </div>
        <div class="card-body px-4 pt-2 pb-4">
          <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label class="form-label">Judul Tiket</label>
              <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Kategori</label>
              <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            
            <!-- <div class="mb-3">
              <label class="form-label">Prioritas</label>
              <select name="priority_id" class="form-control" required>
                <option value="">-- Pilih Prioritas --</option>
                @foreach($priorities as $priority)
                  <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                @endforeach
              </select>
            </div> -->

            <div class="mb-3">
              <label class="form-label">Deskripsi</label>
              <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Upload Bukti (opsional)</label>
              <input type="file" name="attachment" class="form-control">
            </div>

            <div class="d-flex justify-content-end">
              <a href="{{ route('tickets.index') }}" class="btn btn-secondary me-2">Batal</a>
              <button type="submit" class="btn btn-primary">Kirim Tiket</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
