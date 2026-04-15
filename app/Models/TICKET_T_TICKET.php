<?php

namespace App\Models;
use App\Models\TicketChat;
use App\Models\TicketPriority;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'priority_id',
        'attachment',
        'user_id',
        'status',
        'berita_acara',
        'dokumen_resmi',
    ];

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'category_id');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Ticket.php
    public function assignment()
    {
        return $this->hasOne(TicketAssignment::class);
    }



    public function chats()
    {
        return $this->hasMany(TicketChat::class);
    }

    public function messages()
    {
        return $this->hasMany(TicketChat::class);
    }


}
