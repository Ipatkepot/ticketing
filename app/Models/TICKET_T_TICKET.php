<?php

namespace App\Models;
use App\Models\TicketChat;
use App\Models\TicketPriority;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TICKET_T_TICKET extends Model
{
    use HasFactory;
    protected $table = 'ticket_t_ticket';

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
        return $this->belongsTo(TICKET_T_TICKET_CATEGORY::class, 'category_id');
    }

    public function priority()
    {
        return $this->belongsTo(TICKET_T_TICKET_PRIORITY::class, 'priority_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function assignment()
    {
       
        return $this->hasOne(TICKET_T_TICKET_ASSIGNMENT::class, 'ticket_id');
    }

  
    public function chats()
    {
       
        return $this->hasMany(TICKET_T_TICKET_CHAT::class, 'ticket_id');
    }

    
    public function messages()
    {
        
        return $this->hasMany(TICKET_T_TICKET_CHAT::class, 'ticket_id');
    }


}
