<?php

namespace App\Http\Controllers;

use App\Events\NewTicketMessage;
use App\Models\Ticket;
use App\Models\TicketChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketChatController extends Controller
{
    /**
     * Simpan pesan baru
     */
     public function store(Request $request, $ticketId)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $ticket = Ticket::findOrFail($ticketId);
        $receiver = User::findOrFail($request->receiver_id);
        $sender = Auth::user();

        $chat = TicketChat::create([
            'ticket_id'   => $ticketId,
            'user_id'     => $sender->id,
            'receiver_id' => $receiver->id,
            'message'     => $request->message,
        ]);

        broadcast(new NewTicketMessage(
            ticketId: $ticketId,
            userId: $sender->id,
            username: $sender->name,
            usertype: $sender->usertype,
            message: $request->message,
            receiverId: $receiver->id,
        ))->toOthers();

        // Tentukan jenis chat berdasarkan usertype pengirim dan penerima
        $internalUserTypes = ['ketuap3ti', 'staff'];

        if (in_array($sender->usertype, $internalUserTypes) && in_array($receiver->usertype, $internalUserTypes)) {
            // Chat internal ketuap3ti <-> staff
            return redirect()->route('tickets.chat.internal', [
                'ticket' => $ticket->id,
                'receiver' => $receiver->id,
            ]);
        } else {
            // Chat user <-> staff/ketuap3ti, atau mahasiswa <-> staff
            return redirect()->route('tickets.chat.user', [
                'ticket' => $ticket->id,
                'receiver' => $receiver->id,
            ]);
        }
    }



    public function chatInternal(Ticket $ticket, User $receiver)
    {
        // Tentukan receiver yang *seharusnya* untuk room ini
        // Jika yang login ketuap3ti -> other = staff yang ditugaskan (ticket->assignment->user)
        // Jika yang login staff -> other = ketuap3ti (misal usertype 'ketuap3ti' ada di sistem)
        
        $authUser = auth()->user();

        if ($authUser->usertype === 'ketuap3ti') {
            $expectedReceiver = $ticket->assignment?->user ?? null; // staff yang ditugaskan
            if (!$expectedReceiver) {
                return back()->with('error', 'Staff yang ditugaskan belum tersedia.');
            }
        } elseif ($authUser->usertype === 'staff') {
            // cari user ketuap3ti, misal ada user dengan usertype ketuap3ti
            $expectedReceiver = User::where('usertype', 'ketuap3ti')->first();
            if (!$expectedReceiver) {
                return back()->with('error', 'Pengguna ketuap3ti tidak ditemukan.');
            }
        } else {
            return back()->with('error', 'Anda tidak memiliki akses ke chat internal ini.');
        }

        // Jika URL receiver berbeda dari expected -> redirect ke URL yang benar
        if ($receiver->id !== $expectedReceiver->id) {
            return redirect()->route('tickets.chat.internal', [
                'ticket' => $ticket->id,
                'receiver' => $expectedReceiver->id,
            ]);
        }

        // Ambil pesan dua arah antara auth user dan receiver untuk tiket ini
    $messages = TicketChat::where('ticket_id', $ticket->id)
        ->where(function ($q) use ($receiver) {
            $q->where(function ($sub) use ($receiver) {  // <-- tambahkan use($receiver)
                $sub->where('user_id', auth()->id())
                    ->where('receiver_id', $receiver->id);
            })->orWhere(function ($sub) use ($receiver) {
                $sub->where('user_id', $receiver->id)
                    ->where('receiver_id', auth()->id());
            });
        })
        ->with('sender')
        ->orderBy('created_at', 'asc')
        ->get();


        return view('tickets.chat-internal', [
            'ticket'      => $ticket,
            'receiver'    => $receiver,
            'receiver_id' => $receiver->id,
            'messages'    => $messages,
        ]);
    }


    public function chatUser(Ticket $ticket, User $receiver)
    {
        // Tentukan receiver yang *seharusnya* untuk room ini
        // Jika yang login staff -> other = pelapor (ticket->user)
        // Kalau yang login bukan staff -> other = staff yang ditugaskan (ticket->assignment->user)
        $expectedReceiver = auth()->user()->usertype === 'staff'
            ? $ticket->user
            : ($ticket->assignment?->user ?? null);

        if (!$expectedReceiver) {
            return back()->with('error', 'Penerima chat tidak tersedia (belum ada staff yang ditugaskan).');
        }

        // Jika URL receiver berbeda dari expected -> redirect ke URL yang benar
        if ($receiver->id !== $expectedReceiver->id) {
            return redirect()->route('tickets.chat.user', [
                'ticket' => $ticket->id,
                'receiver' => $expectedReceiver->id,
            ]);
        }

        // Ambil pesan dua arah antara auth user dan receiver
        $messages = TicketChat::where('ticket_id', $ticket->id)
            ->where(function ($q) use ($receiver) {
                $q->where(function ($sub) use ($receiver) {
                    $sub->where('user_id', auth()->id())
                        ->where('receiver_id', $receiver->id);
                })->orWhere(function ($sub) use ($receiver) {
                    $sub->where('user_id', $receiver->id)
                        ->where('receiver_id', auth()->id());
                });
            })
            ->with('sender') // eager load sender (relasi di model TicketChat: sender())
            ->orderBy('created_at', 'asc')
            ->get();

        return view('tickets.chat-user', [
            'ticket'      => $ticket,
            'receiver'    => $receiver,
            'receiver_id' => $receiver->id,
            'messages'    => $messages
        ]);
    }

    public function showAdminHistory($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        // Ambil semua chat di tiket ini
        $messages = TicketChat::with('user')
            ->where('ticket_id', $ticketId)
            ->orderBy('created_at', 'asc')
            ->get();

        // Filter internal dan user
        $internalMessages = $messages->filter(function ($msg) {
            return in_array($msg->user->usertype, ['staff', 'ketuap3ti']) &&
                in_array($msg->receiver?->usertype, ['staff', 'ketuap3ti']);
        });

        $userMessages = $messages->filter(function ($msg) {
            return !(
                in_array($msg->user->usertype, ['staff', 'ketuap3ti']) &&
                in_array($msg->receiver?->usertype, ['staff', 'ketuap3ti'])
            );
        });

        return view('tickets.admin-history', compact('ticket', 'internalMessages', 'userMessages'));
    }
}
