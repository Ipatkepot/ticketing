<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $table = 'TICKET_T_TICKET_CATEGORY';
    protected $fillable = [
        'name',
    ];
}
