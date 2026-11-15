
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f6f9;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
        }
        .card {
            padding: 20px;
            margin: 15px 0;
            background: #e8f0fe;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #e8e8e8;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Laporan Penjualan</h1>

    <form method="GET" action="{{ route('report.sales') }}">
        <label>Tanggal Awal:</label>
        <input type="date" name="start_date" value="{{ $start }}">

        <label>Tanggal Akhir:</label>
        <input type="date" name="end_date" value="{{ $end }}">

        <button type="submit">Tampilkan</button>
    </form>

    <a href="{{ route('report.export', [
    'start_date' => $start,
    'end_date' => $end
]) }}">
    Export Excel
</a>

    <div class="card">
        <h3>Total Penjualan</h3>
        <h2>Rp {{ number_format($totalSales, 0, ',', '.') }}</h2>
    </div>

    <div class="card">
        <h3>Jumlah Transaksi</h3>
        <h2>{{ $totalTransactions }}</h2>
    </div>

    <h2>Data Transaksi</h2>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->user->name ?? '-' }}</td>
                    <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
