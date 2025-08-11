@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Daftar Tiket Saya</h6>
          <a href="{{ route('tickets.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Buat Tiket Baru
          </a>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
          @if(session('success'))
            <div class="alert alert-success mx-4 mt-3">
              {{ session('success') }}
            </div>
          @endif

          <div class="table-responsive p-3">
            <table class="table align-items-center mb-0 text-center">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Judul</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Kategori</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Prioritas</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Status</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Dibuat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
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
                      <td>{{ $ticket->category?->name ?? '-' }}</td>
                      <td>{{ $ticket->priority?->name ?? '-' }}</td>
                      <td>{{ ucfirst($ticket->status ?? '-') }}</td>
                      <td>{{ $ticket->created_at?->format('d M Y H:i') ?? '-' }}</td>
                      <td>
                          @php
                              $usertype = auth()->user()->usertype;
                          @endphp

                          {{-- Semua role kecuali p3ti dan ketuap3ti --}}
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
                      </td>
                  </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
