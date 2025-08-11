@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Edit Prioritas Tiket</h6>
        </div>
        <div class="card-body">
          <form action="{{ route('ticket_priorities.update', $ticketPriority->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="name" class="form-label">Nama Prioritas</label>
              <input type="text" name="name" value="{{ $ticketPriority->name }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('ticket_priorities.index') }}" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
