<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketPriority extends Model
{
    protected $table = 'TICKET_T_TICKET_PRIORITY';
    protected $fillable = [
        'name',
    ];
}
