<?php

namespace App\Http\Controllers;

use App\Models\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketTTicketPriorityController extends Controller
{
    public function __construct()
    {
        if (Auth::check() && Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized access.');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket_priorities = \App\Models\TicketPriority::all();
        $ticket_priorities = TicketPriority::orderBy('name', 'asc')->paginate(10); 
        return view('ticket_priorities.index', compact('ticket_priorities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket_priorities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        TicketPriority::create([
            'name' => $request->name,
        ]);

        return redirect()->route('ticket_priorities.index')->with('success', 'Prioritas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketPriority $ticketPriority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketPriority $ticketPriority)
    {
        return view('ticket_priorities.edit', compact('ticketPriority'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketPriority $ticketPriority)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $ticketPriority->update([
            'name' => $request->name,
        ]);

        return redirect()->route('ticket_priorities.index')->with('success', 'Prioritas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketPriority $ticketPriority)
    {
        $ticketPriority->delete();
        return redirect()->route('ticket_priorities.index')->with('success', 'Prioritas berhasil dihapus.');
    }
}
