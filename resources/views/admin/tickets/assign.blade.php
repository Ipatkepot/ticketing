@extends('layouts.app')

@section('content')
@php
  $allowed = in_array(auth()->user()->usertype, ['admin', 'ketuap3ti']);
@endphp

@if($allowed)
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-8"> {{-- Ukuran sedang agar tidak terlalu lebar --}}
      <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Penugasan Staff</h6>
          <small><strong>Tiket:</strong> {{ $ticket->title }}</small>
        </div>
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          <form method="POST" action="{{ route('admin.tickets.assign', $ticket->id) }}">
            @csrf
            <select name="user_id" class="form-select" required>
              <option value="" disabled {{ is_null(optional($ticket->assignment)->user_id) ? 'selected' : '' }}>
              -- Pilih Staff --
            </option>
              @foreach ($staffList as $staff)
                <option value="{{ $staff->id }}"
                  {{ optional($ticket->assignment)->user_id == $staff->id ? 'selected' : '' }}>
                  {{ $staff->name }}
                </option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-primary mt-2">Tugaskan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
