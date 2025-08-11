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
  <div class="card mb-4">
  <div class="card-body">
    <form method="GET" class="row g-3 align-items-end">
      <div class="col-md-4">
        <label for="priority" class="form-label">Filter Prioritas</label>
        <select name="priority" id="priority" class="form-select">
          <option value="">-- Semua Prioritas --</option>
          @foreach($priorityList as $p)
            <option value="{{ $p }}" {{ request('priority') == $p ? 'selected' : '' }}>
              {{ ucfirst($p) }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4">
        <label for="status" class="form-label">Filter Status</label>
        <select name="status" id="status" class="form-select">
          <option value="">-- Semua Status --</option>
          @foreach($statuses as $s)
            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
              {{ ucfirst($s) }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4">
        <button class="btn btn-primary w-100" type="submit">
          <i class="fas fa-filter me-1"></i> Terapkan Filter
        </button>
      </div>
    </form>
  </div>
</div>
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
                <td class="px-2 py-1">
                  @if(auth()->user()->usertype === 'admin')
                  <form method="POST" action="{{ route('admin.tickets.updatePriority', $ticket->id) }}">
                    @csrf
                    @method('PATCH')
                    <select name="priority_id" class="form-select form-select-sm" onchange="this.form.submit()">
                      <option value="">-- Pilih Prioritas --</option>
                      @foreach($priorities as $priority)
                        <option value="{{ $priority->id }}" {{ $ticket->priority_id == $priority->id ? 'selected' : '' }}>
                          {{ $priority->name }}
                        </option>
                      @endforeach
                    </select>
                  </form>
                @else
                  <span class="badge bg-secondary">
                    {{ $ticket->priority->name ?? 'Belum Ditentukan' }}
                  </span>
                @endif
                </td>
                <td class="px-2 py-1">{{ ucfirst($ticket->status) }}</td>
                <td class="px-2 py-1">{{ $ticket->created_at->format('d M Y H:i') }}</td>
                <td class="px-2 py-1">
                  {{-- Tombol Chat --}}
                    @php
                        $usertype = auth()->user()->usertype;
                    @endphp

                    {{-- Semua role kecuali p3ti --}}
                    @if($usertype !== 'p3ti' && $usertype !== 'ketuap3ti')
                        <a href="{{ route('tickets.chat.user', [
                        'ticket' => $ticket->id,
                        'receiver' => $ticket->user_id
                    ]) }}" class="btn btn-sm btn-info mb-1">
                        <i class="fas fa-comments"></i> Chat
                    </a>
                    @endif

                    {{-- Khusus ketuap3ti, chat internal dengan staff --}}
                    @if($usertype === 'ketuap3ti' && $ticket->assignment && $ticket->assignment->staff)
                        <a href="{{ route('tickets.chat.internal', [
                            'ticket'   => $ticket->id,
                            'receiver' => $ticket->assignment->staff->id
                        ]) }}" 
                          class="btn btn-sm btn-warning mb-1">
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

                  {{-- Untuk admin atau usertype lainnya --}}
                  @else
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
                      <select name="status" class="form-select form-select-sm mt-1" onchange="this.form.submit()"
                        {{ !in_array(auth()->user()->usertype, ['staff', 'admin']) ? 'disabled' : '' }}>
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
