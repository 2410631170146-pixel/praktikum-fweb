<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Transaction::sum('total');
        $totalTransactions = Transaction::count();
        $totalIncome = Transaction::sum('total');

        $transactions = Transaction::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Grafik tren penjualan 7 hari terakhir
        $trendLabels = [];
        $trendData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $trendLabels[] = $date->format('d/m');

            $trendData[] = Transaction::whereDate('created_at', $date)
                ->sum('total');
        }

        // 5 produk terlaris
        $bestSellingProducts = TransactionDetail::with('product')
            ->selectRaw('product_id, SUM(qty) as total_qty')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalSales',
            'totalTransactions',
            'totalIncome',
            'transactions',
            'trendLabels',
            'trendData',
            'bestSellingProducts'
        ));
    }
}
