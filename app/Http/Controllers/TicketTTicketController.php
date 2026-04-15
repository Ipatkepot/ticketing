<?php

namespace App\Http\Controllers;

use App\Models\TICKET_T_TICKET;
use App\Models\TICKET_T_TICKET_CATEGORY;
use App\Models\TICKET_T_TICKET_PRIORITY;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketTTicketController extends Controller
{
    public function index()
    {
        $tickets = TICKET_T_TICKET::with(['user', 'category', 'priority', 'assignment.staff'])
        ->where('user_id', Auth::id())
        ->orderBy('title', 'desc')
        ->paginate(10);

        return view('tickets.index', compact('tickets'));

    }

    public function create()
    {
        $categories = TICKET_T_TICKET_CATEGORY::all();
        $priorities = TICKET_T_TICKET_PRIORITY::all();
        return view('tickets.create', compact('categories', 'priorities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:ticket_categories,id',
            // 'priority_id' => 'required|exists:ticket_priorities,id',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Simpan file jika ada
        $attachment = null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment')->store('attachments', 'public');
        }

        //dd($request->all(), $attachment);

        // Simpan tiket
        Ticket::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'priority_id' => null,
            'attachment' => $attachment, // <- ini yang kadang lupa
            'status' => 'open',
        ]);

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibuat.');
    }


    //  Tambahkan method show detail tiket
    public function show(TICKET_T_TICKET $ticket)
    {
        // hanya user terkait atau admin/staff yang bisa lihat
        $user = Auth::user();
        if ($user->id !== $ticket->user_id && !in_array($user->usertype, ['admin', 'staff'])) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }

    public function updatePriority(Request $request, $id)
    {
        $request->validate([
            'priority_id' => 'required|exists:ticket_priorities,id'
        ]);

        $ticket = TICKET_T_TICKET::findOrFail($id);
        $ticket->priority_id = $request->priority_id;
        $ticket->save();

        return back()->with('success', 'Prioritas tiket berhasil diperbarui.');
    }


    public function storeBeritaAcara(Request $request, TICKET_T_TICKET $ticket)
    {
        // Pastikan hanya staff yang ditugaskan yang bisa menyimpan
        if (auth()->user()->usertype !== 'staff' || $ticket->assignment->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'berita_acara' => 'required|string',
        ]);

        $ticket->berita_acara = $request->berita_acara;
        $ticket->save();

        return back()->with('success', 'Berita acara berhasil disimpan.');
    }

    public function uploadDokumen(Request $request, TICKET_T_TICKET $ticket)
    {
        $request->validate([
            'dokumen_resmi' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Cek apakah user adalah staff yang ditugaskan
        if (
            auth()->user()->usertype !== 'staff' ||
            !$ticket->assignment ||
            $ticket->assignment->user_id !== auth()->id()
        ) {
            abort(403, 'Unauthorized');
        }

        // Simpan file
        if ($request->hasFile('dokumen_resmi')) {
            $path = $request->file('dokumen_resmi')->store('dokumen_resmi', 'public');
            $ticket->update([
                'dokumen_resmi' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Dokumen resmi berhasil diunggah.');
    }

    public function edit(TICKET_T_TICKET $ticket)
    {
        //
    }

    public function update(Request $request, TICKET_T_TICKET $ticket)
    {
        //
    }

    public function destroy(TICKET_T_TICKET $ticket)
    {
        //
    }
}
