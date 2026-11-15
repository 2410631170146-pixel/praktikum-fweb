
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Analitik Penjualan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Ringkasan Penjualan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 dark:text-gray-300">Total Penjualan</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        Rp {{ number_format($totalSales, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 dark:text-gray-300">Total Transaksi</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $totalTransactions }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 dark:text-gray-300">Total Pendapatan</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        Rp {{ number_format($totalIncome, 0, ',', '.') }}
                    </p>
                </div>

            </div>

            <!-- Grafik Penjualan -->
            <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Grafik Analitik Penjualan
                </h3>

                <div style="height: 350px;">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    5 Transaksi Terbaru
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-700 dark:text-gray-200">
                        <thead>
                            <tr class="border-b dark:border-gray-600">
                                <th class="p-3">No. Invoice</th>
                                <th class="p-3">Pelanggan</th>
                                <th class="p-3">Total</th>
                                <th class="p-3">Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="p-3">{{ $transaction->invoice_number }}</td>
                                    <td class="p-3">{{ $transaction->user->name ?? '-' }}</td>
                                    <td class="p-3">
                                        Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                    </td>
                                    <td class="p-3">
                                        {{ $transaction->created_at->format('d-m-Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-3 text-center">
                                        Belum ada transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('salesChart');

            if (canvas) {
                new Chart(canvas, {
                    type: 'bar',
                    data: {
                        labels: ['Total Penjualan', 'Total Pendapatan'],
                        datasets: [{
                            label: 'Jumlah (Rupiah)',
                            data: [
                                {{ $totalSales }},
                                {{ $totalIncome }}
                            ],
                            backgroundColor: [
                                'rgba(59, 130, 246, 0.7)',
                                'rgba(16, 185, 129, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>
