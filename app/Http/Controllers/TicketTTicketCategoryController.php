<?php

namespace App\Http\Controllers;

use App\Models\TICKET_T_TICKET_CATEGORY;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketTTicketCategoryController extends Controller
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
        $ticket_categories = \App\Models\TICKET_T_TICKET_CATEGORY::all();
        $ticket_categories = TICKET_T_TICKET_CATEGORY::orderBy('name', 'asc')->paginate(10);
        return view('ticket_categories.index', compact('ticket_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        TICKET_T_TICKET_CATEGORY::create([
            'name' => $request->name,
        ]);

        return redirect()->route('ticket_categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TICKET_T_TICKET_CATEGORY $ticketCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TICKET_T_TICKET_CATEGORY $ticketCategory)
    {
        return view('ticket_categories.edit', compact('ticketCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TICKET_T_TICKET_CATEGORY $ticketCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $ticketCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('ticket_categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TICKET_T_TICKET_CATEGORY $ticketCategory)
    {
        $ticketCategory->delete();
        return redirect()->route('ticket_categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
