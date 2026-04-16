<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TICKET_T_TICKET;
use App\Models\User;
use App\Models\TICKET_T_TICKET_PRIORITY;
use App\Models\TICKET_T_TICKET_ASSIGNMENT;
use Illuminate\Http\Request;

class TicketManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = TICKET_T_TICKET::with(['category', 'priority', 'user', 'assignment.user']);

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
        $priorityList = \App\Models\TICKET_T_TICKET_PRIORITY::pluck('name')->toArray(); // untuk filter dropdown atas
        $priorities = \App\Models\TICKET_T_TICKET_PRIORITY::all(); // untuk dropdown ubah prioritas
        $statuses = ['open', 'in_progress', 'resolved', 'closed', 'rejected'];

        return view('admin.tickets.index', compact('tickets', 'priorities', 'priorityList', 'statuses'));
    }



    public function updateStatus(Request $request, TICKET_T_TICKET $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,rejected,closed'
        ]);

        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->back()->with('success', 'Status tiket berhasil diperbarui.');
    }

    public function show(TICKET_T_TICKET $ticket)
{
    $ticket->load(['user', 'category', 'priority', 'chats.user']);

    $messages = $ticket->messages()
        ->with(['user', 'receiver'])
        ->orderBy('created_at')
        ->get();

    // Bedakan chat internal vs user
    $internalMessages = $messages->filter(function ($msg) {
        return in_array($msg->user?->usertype, ['staff', 'ketuap3ti']) &&
               in_array($msg->receiver?->usertype, ['staff', 'ketuap3ti']);
    });

    $userMessages = $messages->filter(function ($msg) {
        return !(
            in_array($msg->user?->usertype, ['staff', 'ketuap3ti']) &&
            in_array($msg->receiver?->usertype, ['staff', 'ketuap3ti'])
        );
    });

    return view('admin.tickets.show', compact(
        'ticket',
        'messages',
        'internalMessages',
        'userMessages'
    ));
}


    // Form assign (ambil dari tabel users yang usertype = staff)
    public function assignForm(TICKET_T_TICKET $ticket)
    {
        $staffList = User::where('usertype', 'staff')->get();
        return view('admin.tickets.assign', compact('ticket', 'staffList'));
    }

    // Simpan penugasan
    public function assign(Request $request, TICKET_T_TICKET $ticket)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        TICKET_T_TICKET_ASSIGNMENT::updateOrCreate(
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

        $ticket = TICKET_T_TICKET::findOrFail($id);
        $ticket->priority_id = $request->priority_id;
        $ticket->save();

        return redirect()->back()->with('success', 'Prioritas tiket berhasil diperbarui.');
    }


}
