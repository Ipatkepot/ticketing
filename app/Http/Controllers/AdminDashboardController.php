<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $todayTickets = TICKET_T_TICKET::whereDate('created_at', today())->count();
        $openTickets = TICKET_T_TICKET::where('status', 'open')->count();
        $inProgressTickets = TICKET_T_TICKET::where('status', 'in_progress')->count();
        $completedTickets = TICKET_T_TICKET::whereIn('status', ['resolved', 'closed'])->count();

        // Data chart: jumlah tiket per bulan
        $monthlyData = TICKET_T_TICKET::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Normalisasi: semua bulan
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlyData[$i] ?? 0;
        }
        return view('admin.admin', compact(
            'todayTickets',
            'openTickets',
            'inProgressTickets',
            'completedTickets',
            'chartData'
        ));
    }
}
