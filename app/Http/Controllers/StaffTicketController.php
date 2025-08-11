<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class StaffTicketController extends Controller
{
    // Menampilkan daftar tiket yang ditugaskan ke staff (berdasarkan user_id di assignments)
    public function index()
    {
        $staffId = Auth::id();

        // Ambil semua tiket yang ditugaskan ke staff ini
        $tickets = Ticket::whereHas('assignment', function ($query) use ($staffId) {
            $query->where('user_id', $staffId);
        })
        ->with(['category', 'priority', 'user'])
        ->latest()
        ->get();

        return view('staff.tickets.index', compact('tickets'));
    }
}

