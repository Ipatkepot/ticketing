<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TICKET_T_TICKET_CHAT extends Model
{
    use HasFactory;
    protected $table = 'ticket_t_ticket_chat';

    protected $fillable = [
        'ticket_id',
        'user_id',
        'receiver_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
