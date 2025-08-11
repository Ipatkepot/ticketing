<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketAssignment;
use Illuminate\Http\Request;

class TicketAssignmentController extends Controller
{
    public function assignForm($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        // Ambil semua user dengan usertype 'staff'
        $personils = User::where('usertype', 'staff')->get();

        return view('admin.tickets.assign', compact('ticket', 'personils'));
    }

    public function assign(Request $request, $ticketId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        TicketAssignment::updateOrCreate(
            ['ticket_id' => $ticketId],
            ['user_id' => $request->user_id]
        );

        return redirect()->route('admin.tickets.index')->with('success', 'Staff berhasil ditugaskan.');
    }

}
