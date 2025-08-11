<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Tiket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 30px;
            color: #000;
        }
        h2, h4 {
            text-align: center;
            margin-bottom: 5px;
        }
        p.date-info {
            text-align: right;
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Tiket</h2>
    <h4>Periode: {{ ucfirst($range) }}</h4>
    <p class="date-info">Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Pelapor</th>
                <th>Kategori</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Tanggal Laporan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $i => $ticket)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->user->name ?? '-' }}</td>
                    <td>{{ $ticket->category->name ?? '-' }}</td>
                    <td>{{ $ticket->priority->name ?? '-' }}</td>
                    <td>{{ ucfirst($ticket->status) }}</td>
                    <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data tiket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
