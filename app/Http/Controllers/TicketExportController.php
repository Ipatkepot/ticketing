<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TicketExportController extends Controller
{
    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Judul');
        $sheet->setCellValue('B1', 'Pelapor');
        $sheet->setCellValue('C1', 'Kategori');
        $sheet->setCellValue('D1', 'Prioritas');
        $sheet->setCellValue('E1', 'Status');
        $sheet->setCellValue('F1', 'Tanggal');

        // Data
        $tickets = Ticket::with(['user', 'category', 'priority'])->get();
        $row = 2;
        foreach ($tickets as $ticket) {
            $sheet->setCellValue('A' . $row, $ticket->title);
            $sheet->setCellValue('B' . $row, $ticket->user->name ?? '-');
            $sheet->setCellValue('C' . $row, $ticket->category->name ?? '-');
            $sheet->setCellValue('D' . $row, $ticket->priority->name ?? '-');
            $sheet->setCellValue('E' . $row, $ticket->status);
            $sheet->setCellValue('F' . $row, $ticket->created_at->format('d M Y H:i'));
            $row++;
        }

        // Response untuk download
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_tiket_' . now()->format('Ymd_His') . '.xlsx';

        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
