<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketPriority;
use App\Models\TicketAssignment;
use Illuminate\Http\Request;

class TicketManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['category', 'priority', 'user', 'assignment.user']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan prioritas (nama)
        if ($request->has('priority') && $request->priority != '') {
            $query->whereHas('priority', function ($q) use ($request) {
                $q->where('name', $request->priority);
            });
        }

        $tickets = $query->latest()->paginate(10);

        //  Ini bagian penting yang kamu ubah:
        $priorityList = \App\Models\TicketPriority::pluck('name')->toArray(); // untuk filter dropdown atas
        $priorities = \App\Models\TicketPriority::all(); // untuk dropdown ubah prioritas
        $statuses = ['open', 'in_progress', 'resolved', 'closed', 'rejected'];

        return view('admin.tickets.index', compact('tickets', 'priorities', 'priorityList', 'statuses'));
    }



    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,rejected,closed'
        ]);

        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->back()->with('success', 'Status tiket berhasil diperbarui.');
    }

    public function show(Ticket $ticket)
    {
        $messages = $ticket->messages()->with('user')->orderBy('created_at')->get();
        $ticket->load(['user', 'category', 'priority', 'chats.user']);
        return view('admin.tickets.show', compact('ticket', 'messages'));
    }

    // Form assign (ambil dari tabel users yang usertype = staff)
    public function assignForm(Ticket $ticket)
    {
        $staffList = User::where('usertype', 'staff')->get();
        return view('admin.tickets.assign', compact('ticket', 'staffList'));
    }

    // Simpan penugasan
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        TicketAssignment::updateOrCreate(
            ['ticket_id' => $ticket->id],
            ['user_id' => $request->user_id]
        );

        return redirect()->route('admin.tickets.index')->with('success', 'Staff berhasil ditugaskan.');
    }

    public function updatePriority(Request $request, $id)
    {
        $request->validate([
            'priority_id' => 'required|exists:ticket_priorities,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->priority_id = $request->priority_id;
        $ticket->save();

        return redirect()->back()->with('success', 'Prioritas tiket berhasil diperbarui.');
    }


}
