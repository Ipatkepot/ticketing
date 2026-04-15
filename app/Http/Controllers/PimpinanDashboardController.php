<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TICKET_T_TICKET;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Barryvdh\DomPDF\Facade\Pdf;

class PimpinanDashboardController extends Controller
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

    public function laporan(Request $request)
    {
        $range = $request->get('range', '');
        $status = $request->get('status', '');

        $query = Ticket::with(['user', 'category', 'priority']);

        if ($range === 'day') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($range === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year);
        } elseif ($range === 'year') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        if ($status !== '') {
            $query->where('status', $status);
        }

        // pakai paginate, bukan get
        $tickets = $query->latest()->paginate(10)->withQueryString();

        return view('pimpinan.laporan', compact('tickets', 'range', 'status'));
    }

    public function export(Request $request, $format)
{
    $range = $request->get('range', '');
    $status = $request->get('status', '');

    $query = Ticket::with(['user', 'category', 'priority']);

    // Filter waktu
    if ($range === 'day') {
        $query->whereDate('created_at', Carbon::today());
    } elseif ($range === 'month') {
        $query->whereMonth('created_at', Carbon::now()->month)
              ->whereYear('created_at', Carbon::now()->year);
    } elseif ($range === 'year') {
        $query->whereYear('created_at', Carbon::now()->year);
    }

    // Filter status
    if ($status !== '') {
        $query->where('status', $status);
    }

    $tickets = $query->latest()->get();

    // === Export PDF ===
    if ($format === 'pdf') {
        $pdf = Pdf::loadView('pimpinan.export.pdf', compact('tickets', 'range', 'status'));
        $filename = 'laporan_tiket_' . ($range ?: 'semua') . ($status ? "_{$status}" : '') . '.pdf';
        return $pdf->download($filename);
    }

    // === Export Excel / CSV ===
    if (in_array($format, ['xlsx', 'csv'])) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->fromArray([
            ['No', 'Judul', 'Pelapor', 'Kategori', 'Prioritas', 'Status', 'Tanggal']
        ], null, 'A1');

        // Data
        $row = 2;
        foreach ($tickets as $i => $ticket) {
            $sheet->fromArray([
                $i + 1,
                $ticket->title,
                $ticket->user->name ?? '-',
                $ticket->category->name ?? '-',
                $ticket->priority->name ?? '-',
                ucfirst($ticket->status),
                $ticket->created_at->format('Y-m-d H:i'),
            ], null, "A{$row}");
            $row++;
        }

        // Writer dan respon
        $writer = $format === 'xlsx' ? new Xlsx($spreadsheet) : new Csv($spreadsheet);
        $filename = 'laporan_tiket_' . ($range ?: 'semua') . ($status ? "_{$status}" : '') . '.' . $format;

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => $format === 'xlsx'
                ? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                : 'text/csv',
        ]);
    }

    // Format tidak dikenal
    abort(404);
}

}
