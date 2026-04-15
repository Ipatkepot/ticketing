@extends('layouts.app')

@section('content')
<div class="container-fluid py-4"> {{-- Ganti dari container ke container-fluid agar lebih lebar --}}
  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="mb-4">Laporan Tiket</h4>

      {{-- Filter & Export --}}
      <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <form method="GET" class="d-flex align-items-center gap-2 flex-wrap">
          <label class="mb-0 fw-semibold">Filter:</label>
          <select name="range" class="form-select w-auto" onchange="this.form.submit()">
            <option value="">Semua</option>
            <option value="day" {{ $range === 'day' ? 'selected' : '' }}>Hari ini</option>
            <option value="month" {{ $range === 'month' ? 'selected' : '' }}>Bulan ini</option>
            <option value="year" {{ $range === 'year' ? 'selected' : '' }}>Tahun ini</option>
          </select>

          <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="open" {{ $status === 'open' ? 'selected' : '' }}>Open</option>
                <option value="in_progress" {{ $status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="resolved" {{ $status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="closed" {{ $status === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </form>

        <div class="d-flex gap-2">
          <a href="{{ route('pimpinan.laporan.export', ['format' => 'pdf', 'range' => $range, 'status' => $status]) }}" class="btn btn-danger">
            <i class="fas fa-file-pdf me-1"></i> PDF
          </a>
          <a href="{{ route('pimpinan.laporan.export', ['format' => 'xlsx', 'range' => $range, 'status' => $status]) }}" class="btn btn-success">
            <i class="fas fa-file-excel me-1"></i> Excel
          </a>
          <a href="{{ route('pimpinan.laporan.export', ['format' => 'csv', 'range' => $range, 'status' => $status]) }}" class="btn btn-secondary">
            <i class="fas fa-file-csv me-1"></i> CSV
          </a>
        </div>
      </div>

      {{-- Table --}}
      <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light text-center">
          <tr>
            <th style="width: 50px;">No</th>
            <th>Judul</th>
            <th>Pelapor</th>
            <th>Kategori</th>
            <th>Prioritas</th>
            <th>Status</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($tickets as $i => $ticket)
            <tr>
              <td class="text-center">
                {{ $tickets->firstItem() + $i }}
              </td>
              <td>{{ $ticket->title }}</td>
              <td>{{ $ticket->user->name ?? '-' }}</td>
              <td>{{ $ticket->category->name ?? '-' }}</td>
              <td>{{ $ticket->priority->name ?? '-' }}</td>
              <td>{{ ucfirst($ticket->status) }}</td>
              <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted">Tidak ada data</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    {{-- Pagination --}}
    <div class="d-flex justify-content-end mt-3">
        {{ $tickets->links('pagination::bootstrap-5') }}
    </div>
    </div>
  </div>
</div>
@endsection
