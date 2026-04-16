<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TICKET_T_TICKET;
use Illuminate\Support\Facades\Auth;

class StaffTicketController extends Controller
{
    // Menampilkan daftar tiket yang ditugaskan ke staff (berdasarkan user_id di assignments)
    public function index()
    {
        $staffId = Auth::id();

     $tickets = TICKET_T_TICKET::with(['category', 'priority', 'user'])
        ->where(function ($query) use ($staffId) {
         
            $query->whereHas('assignment', function ($q) use ($staffId) {
                $q->where('user_id', $staffId);
            })
        
            ->orWhereDoesntHave('assignment');
        })
        ->latest()
        ->get();
        return view('staff.tickets.index', compact('tickets'));
    }
}

