<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTicketMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ticketId;
    public $userId;
    public $username;
    public $usertype;
    public $message;
    public $receiverId;
    public $time;
    public $timestamp;

    public function __construct($ticketId, $userId, $username, $usertype, $message, $receiverId)
    {
        $this->ticketId = $ticketId;
        $this->userId = $userId;
        $this->username = $username;
        $this->usertype = $usertype;
        $this->message = $message;
        $this->receiverId = $receiverId;
        $this->time = now()->format('H:i');
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel("ticket-{$this->ticketId}.{$this->receiverId}");
    }

    public function broadcastWith(): array
    {
        return [
            'user_id'     => $this->userId,
            'username'    => $this->username,
            'usertype'    => $this->usertype,
            'message'     => $this->message,
            'receiver_id' => $this->receiverId,
            'time'        => now()->toIso8601String(),
        ];
    }

    public function broadcastAs(): string
    {
        return 'NewTicketMessage';
    }
}
