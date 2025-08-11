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
        $todayTickets = Ticket::whereDate('created_at', today())->count();
        $openTickets = Ticket::where('status', 'open')->count();
        $inProgressTickets = Ticket::where('status', 'in_progress')->count();
        $completedTickets = Ticket::whereIn('status', ['resolved', 'closed'])->count();

        // Data chart: jumlah tiket per bulan
        $monthlyData = Ticket::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
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
