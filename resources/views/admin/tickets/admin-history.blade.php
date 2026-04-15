@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h4 class="fw-bold mb-4">Riwayat Chat Tiket #{{ $ticket->id }}</h4>

  {{-- Bagian chat user --}}
  <h5 class="mt-4">Chat User ↔ Staff/Ketua P3TI</h5>
  <div class="card shadow-sm mb-4">
    <div class="card-body p-3" style="max-height: 300px; overflow-y: auto; background-color: #f8f9fa;">
      @forelse($userMessages as $msg)
        <div class="mb-3">
          <div class="p-2 px-3 rounded-3 shadow-sm {{ $msg->user_id === auth()->id() ? 'bg-primary text-white' : 'bg-light text-dark' }}" style="max-width: 75%;">
            <div class="small fw-bold mb-1 d-flex justify-content-between">
              <span>{{ $msg->user->name ?? 'Anonim' }}</span>
              <span class="text-muted small">{{ $msg->created_at->timezone('Asia/Jakarta')->format('H:i') }}</span>
            </div>
            <div class="small">{{ $msg->message }}</div>
          </div>
        </div>
      @empty
        <p class="text-muted">Belum ada chat user.</p>
      @endforelse
    </div>
  </div>

  {{-- Bagian chat internal --}}
  <h5 class="mt-4">Chat Internal (Staff ↔ Ketua P3TI)</h5>
  <div class="card shadow-sm">
    <div class="card-body p-3" style="max-height: 300px; overflow-y: auto; background-color: #f8f9fa;">
      @forelse($internalMessages as $msg)
        <div class="mb-3">
          <div class="p-2 px-3 rounded-3 shadow-sm {{ $msg->user_id === auth()->id() ? 'bg-success text-white' : 'bg-light text-dark' }}" style="max-width: 75%;">
            <div class="small fw-bold mb-1 d-flex justify-content-between">
              <span>{{ $msg->user->name ?? 'Anonim' }}</span>
              <span class="text-muted small">{{ $msg->created_at->timezone('Asia/Jakarta')->format('H:i') }}</span>
            </div>
            <div class="small">{{ $msg->message }}</div>
          </div>
        </div>
      @empty
        <p class="text-muted">Belum ada chat internal.</p>
      @endforelse
    </div>
  </div>
</div>
@endsection
