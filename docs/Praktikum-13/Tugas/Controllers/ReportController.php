<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $start = $request->start_date
            ?? now()->subDays(7)->toDateString();

        $end = $request->end_date
            ?? now()->toDateString();

        $transactions = Transaction::with('user')
            ->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ])
            ->latest()
            ->get();

        $totalSales = $transactions->sum('total');
        $totalTransactions = $transactions->count();

        return view('reports.sales', compact(
            'transactions',
            'totalSales',
            'totalTransactions',
            'start',
            'end'
        ));
    }

    public function export()
    {
        return Excel::download(
            new SalesExport(),
            'laporan-penjualan.xlsx'
        );
    }
}
