<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #1e3a5f; color: white; padding: 8px; text-align: left; }
        td { padding: 7px 8px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background: #f9f9f9; }
    </style>
</head>
<body>
    <h3>Laporan Keluhan Lab Informatika</h3>
    <p style="text-align:center">Dicetak pada: {{ now()->format('d F Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Mahasiswa</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keluhans as $i => $k)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $k->user->name }}</td>
                <td>{{ $k->judul }}</td>
                <td>{{ ucfirst($k->kategori) }}</td>
                <td>{{ ucfirst($k->status) }}</td>
                <td>{{ $k->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>