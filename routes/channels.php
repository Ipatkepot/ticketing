<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{ticketId}', function ($user, $ticketId) {
    // Kamu bisa sesuaikan logikanya, misalnya hanya user terkait tiket saja
    return true;
});

Broadcast::channel('ticket.{ticketId}', function ($user, $ticketId) {
    return true; // Nanti bisa kamu ganti jadi validasi owner ticket
});
