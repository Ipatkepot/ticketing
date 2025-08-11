@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h5 class="mb-4 fw-semibold">Chat Internal (Staff ⟷ Ketua P3TI)</h5>

  <div class="card shadow-sm border-0">
    <div class="card-body" id="chat-messages" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
      @forelse($messages as $msg)
        @php
          $isOwn = $msg->user_id === auth()->id();
        @endphp
        <div class="d-flex mb-3 {{ $isOwn ? 'justify-content-end' : 'justify-content-start' }}">
          <div class="p-3 rounded-3 shadow-sm"
               style="max-width: 70%; background-color: {{ $isOwn ? '#198754' : '#ffffff' }};
                      color: {{ $isOwn ? 'white' : '#333' }};">
            <div class="small fw-bold mb-1 d-flex justify-content-between">
              <span>{{ $msg->sender->name ?? 'Anonim' }}</span>
              <span class="text-muted">{{ $msg->created_at->format('H:i') }}</span>
            </div>
            <div class="lh-sm">{{ $msg->message }}</div>
          </div>
        </div>
      @empty
        <p class="text-muted text-center my-4">Belum ada pesan.</p>
      @endforelse
      <div id="chat-end"></div>
    </div>

    <div class="card-footer bg-white border-top">
      <form method="POST" action="{{ route('tickets.chat.store', $ticket->id) }}">
        @csrf
        
        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
        <div class="input-group">
          <input type="text" name="message" class="form-control" placeholder="Tulis pesan..." required autofocus>
          <button type="submit" class="btn btn-success">
            <i class="fas fa-paper-plane"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
window.Echo.private(channelName)
  .listen('.NewTicketMessage', function (e) {
    const isOwn = e.user_id === {{ auth()->id() }};
    
    const wrapper = document.createElement('div');
    wrapper.className = 'd-flex mb-3 ' + (isOwn ? 'justify-content-end' : 'justify-content-start');

    const bubble = document.createElement('div');
    bubble.className = 'p-3 rounded-3 shadow-sm';
    bubble.style.maxWidth = '70%';
    bubble.style.backgroundColor = isOwn ? '#198754' : '#ffffff';
    bubble.style.color = isOwn ? 'white' : '#333';

    bubble.innerHTML = `
      <div class="small fw-bold mb-1 d-flex justify-content-between">
        <span>${e.username}</span>
        <span class="text-muted">${e.time}</span>
      </div>
      <div class="lh-sm">${e.message}</div>
    `;

    wrapper.appendChild(bubble);
    document.getElementById('chat-messages').appendChild(wrapper);
    document.getElementById('chat-end').scrollIntoView({ behavior: 'smooth' });
  });
</script>
@endpush
