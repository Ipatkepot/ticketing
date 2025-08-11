<?php

namespace App\Events;

use App\Models\TicketChat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketChatSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    public function __construct(TicketChat $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn(): Channel
    {
        // Kirim ke channel yang sesuai: internal atau user
        $channelType = $this->chat->room_type === 'internal' ? 'ticket-internal' : 'ticket-user';

        return new PrivateChannel("{$channelType}.{$this->chat->ticket_id}.{$this->chat->receiver_id}");
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->chat->id,
            'user_id' => $this->chat->user_id,
            'receiver_id' => $this->chat->receiver_id,
            'ticket_id' => $this->chat->ticket_id,
            'message' => $this->chat->message,
            'created_at' => $this->chat->created_at->format('H:i'),
            'user_name' => $this->chat->user->name ?? 'Anon',
            'usertype' => $this->chat->user->usertype ?? '-'
        ];
    }

    public function broadcastAs(): string
    {
        return 'NewTicketMessage';
    }
}
