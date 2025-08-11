@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <h4 class="mb-3">Detail Tiket: {{ $ticket->title }}</h4>

  <div class="card">
    <div class="card-body">
      <p><strong>Pelapor:</strong> {{ $ticket->user?->name ?? '-' }}</p>
      <p><strong>Kategori:</strong> {{ $ticket->category?->name ?? '-' }}</p>
      <p><strong>Prioritas:</strong> {{ $ticket->priority?->name ?? '-' }}</p>
      <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
      <p><strong>Dibuat:</strong> {{ $ticket->created_at->format('d M Y H:i') }}</p>
      <p><strong>Deskripsi:</strong><br>{{ $ticket->description }}</p>

      @if ($ticket->attachment)
        <p><strong>File Bukti:</strong></p>
        <img src="{{ asset('storage/' . $ticket->attachment) }}" alt="Bukti Keluhan" class="img-fluid mb-3" style="max-width: 400px;">
      @endif

      @if(auth()->user()->usertype === 'staff' && $ticket->assignment && $ticket->assignment->user_id === auth()->id())
          <form method="POST" action="{{ route('tickets.berita_acara.store', $ticket->id) }}">
              @csrf
              <div class="mb-3 mt-4">
                  <label for="berita_acara" class="form-label">Berita Acara</label>
                  <textarea name="berita_acara" id="berita_acara" class="form-control" rows="5" required>{{ old('berita_acara', $ticket->berita_acara) }}</textarea>
              </div>
              <button type="submit" class="btn btn-success">Simpan Berita Acara</button>
          </form>
      @endif
      @if(auth()->user()->usertype === 'staff' && $ticket->assignment && $ticket->assignment->user_id === auth()->id())
        <form method="POST" action="{{ route('tickets.dokumen.store', $ticket->id) }}" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="dokumen_resmi" class="form-label">Unggah Dokumen Resmi (PDF/DOCX)</label>
                <input type="file" name="dokumen_resmi" class="form-control" accept=".pdf,.doc,.docx" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      @endif


      @if($ticket->berita_acara)
      <div class="mt-5">
        <h5 class="mb-3 text-success fw-semibold">
          <i class="fas fa-file-alt me-2"></i> Berita Acara
        </h5>

        <div class="card border-0 shadow-sm bg-white">
          <div class="card-body" style="font-size: 0.95rem; line-height: 1.6;">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">
                <i class="fas fa-user me-1"></i>
                {{ optional($ticket->assignment?->user)->name ?? '-' }}
              </small>
              <small class="text-muted">
                <i class="fas fa-clock me-1"></i>
                {{ $ticket->updated_at->format('d M Y H:i') }}
              </small>
            </div>
            <hr>
            <div>
              {!! nl2br(e($ticket->berita_acara)) !!}
            </div>
          </div>
        </div>
      </div>
    @endif

    @if(auth()->user()->usertype !== 'mahasiswa' && $ticket->dokumen_resmi)
      <div class="mt-4">
        <h5 class="mb-3 text-primary fw-semibold">
          <i class="fas fa-file-upload me-2"></i> Dokumen Resmi
        </h5>

        <div class="card border-0 shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span>
              📎 {{ basename($ticket->dokumen_resmi) }}
            </span>
            <a href="{{ asset('storage/' . $ticket->dokumen_resmi) }}" class="btn btn-sm btn-outline-primary" target="_blank">
              Download
            </a>
          </div>
        </div>
      </div>
    @endif
      @if(auth()->user()->usertype === 'admin')
      <h5 class="mt-4">Riwayat Pesan</h5>
      <div class="card shadow-sm">
        <div class="card-body p-3" style="max-height: 350px; overflow-y: auto; background-color: #f8f9fa;">
          @forelse($messages as $message)
            @php
              $isOwn = $message->user_id === auth()->id();
            @endphp
            <div class="d-flex mb-3 {{ $isOwn ? 'justify-content-end' : 'justify-content-start' }}">
              <div class="p-2 px-3 rounded-3 shadow-sm {{ $isOwn ? 'bg-primary text-white' : 'bg-light text-dark' }}" style="max-width: 75%;">
                <div class="small fw-bold mb-1">
                  {{ $message->user?->name ?? 'User tidak ditemukan' }}
                  <span class="text-muted float-end small">{{ $message->created_at->format('H:i') }}</span>
                </div>
                <div class="small">{{ $message->message }}</div>
              </div>
            </div>
          @empty
            <p class="text-muted">Belum ada pesan pada tiket ini.</p>
          @endforelse
        </div>
      </div>
@endif
@endsection
