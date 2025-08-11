@extends('layouts.app')

@section('content')
<style>
  td, th {
    font-size: 0.85rem;
    padding: 6px !important;
  }
  .btn-sm {
    font-size: 0.75rem;
    padding: 4px 8px;
  }
</style>
<div class="container-fluid py-4">
  <h4 class="mb-3">Daftar Tiket Masuk</h4>
  <div class="card">
    <div class="card-body px-0 pt-0 pb-2">
      <div class="table-responsive p-3">
        <table class="table table-striped table-sm align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>Judul</th>
              <th>Pelapor</th>
              <th>Kategori</th>
              <th>Prioritas</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tickets as $ticket)
              <tr>
                <td>
                  <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-primary text-decoration-underline fw-semibold">
                    <i class="fas fa-eye"></i> {{ $ticket->title }}
                  </a>
                </td>
                <td class="px-2 py-1">{{ $ticket->user->name ?? '-' }}</td>
                <td class="px-2 py-1">{{ $ticket->category->name ?? '-' }}</td>
                <td class="px-2 py-1">{{ $ticket->priority->name ?? '-' }}</td>
                <td class="px-2 py-1">{{ ucfirst($ticket->status) }}</td>
                <td class="px-2 py-1">{{ $ticket->created_at->format('d M Y H:i') }}</td>
                <td class="px-2 py-1">
                {{-- Tombol Chat --}}
                  @php
                      $usertype = auth()->user()->usertype;
                  @endphp

                  {{-- Chat User (staff → pelapor) --}}
                  @if($usertype === 'staff' && $ticket->user)
                      <a href="{{ route('tickets.chat.user', [
                          'ticket' => $ticket->id,
                          'receiver' => $ticket->user->id
                      ]) }}" class="btn btn-sm btn-info mb-1">
                          <i class="fas fa-comments"></i> Chat
                      </a>
                  @endif

                  {{-- Chat Internal (staff ↔ ketuap3ti) --}}
                  @if($ticket->assignment && $ticket->assignment->staff)
                      <a href="{{ route('tickets.chat.internal', [
                          'ticket' => $ticket->id,
                          'receiver' => $ticket->assignment->staff->id
                      ]) }}" class="btn btn-sm btn-info mb-1">
                          <i class="fas fa-comments"></i> Chat Internal
                      </a>
                  @endif
                {{-- Jika usertype adalah 'staff' --}}
                @if (auth()->user()->usertype === 'staff')
                  <form action="{{ route('admin.tickets.updateStatus', $ticket->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-select form-select-sm mt-1" onchange="this.form.submit()">
                      <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                      <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                      <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                      <option value="rejected" {{ $ticket->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                      <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                  </form>
                {{-- Jika usertype adalah 'ketuap3ti' --}}
                @elseif (auth()->user()->usertype === 'ketuap3ti')
                  @if ($ticket->assignment)
                    <a href="{{ route('admin.tickets.assign.form', $ticket->id) }}" class="btn btn-sm btn-success mb-1">
                      <i class="fas fa-check"></i> Sudah Ditugaskan
                    </a>
                  @else
                    <a href="{{ route('admin.tickets.assign.form', $ticket->id) }}" class="btn btn-sm btn-warning mb-1">
                      <i class="fas fa-user-check"></i> Tugaskan
                    </a>
                  @endif

                {{-- Jika admin atau role lain --}}
                @else
                  {{-- Bisa dibiarkan tampil semua opsi jika kamu mau --}}
                  @if ($ticket->assignment)
                    <a href="{{ route('admin.tickets.assign.form', $ticket->id) }}" class="btn btn-sm btn-success mb-1">
                      <i class="fas fa-check"></i> Sudah Ditugaskan
                    </a>
                  @else
                    <a href="{{ route('admin.tickets.assign.form', $ticket->id) }}" class="btn btn-sm btn-warning mb-1">
                      <i class="fas fa-user-check"></i> Tugaskan
                    </a>
                  @endif

                  <form action="{{ route('admin.tickets.updateStatus', $ticket->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-select form-select-sm mt-1" onchange="this.form.submit()">
                      <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                      <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                      <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                      <option value="rejected" {{ $ticket->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                      <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                  </form>
                @endif
              </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
