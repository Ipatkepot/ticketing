<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TICKET_T_TICKET_ASSIGNMENT extends Model
{
    use HasFactory;
    
    protected $table = 'ticket_t_ticket_assignment';
    protected $fillable = ['ticket_id', 'user_id'];
    

    public function ticket()
    {
        return $this->belongsTo(\App\Models\TICKET_T_TICKET::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



}
