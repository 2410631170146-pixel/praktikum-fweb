
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
                    <h3 class="text-gray-500 dark:text-gray-300">
                        Total Penjualan
                    </h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        Rp {{ number_format($totalSales, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 dark:text-gray-300">
                        Total Transaksi
                    </h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $totalTransactions }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 dark:text-gray-300">
                        Total Pendapatan
                    </h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        Rp {{ number_format($totalIncome, 0, ',', '.') }}
                    </p>
                </div>

            </div>

            <!-- Grafik Tren Penjualan -->
            <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Grafik Tren Penjualan 7 Hari Terakhir
                </h3>

                <div style="position: relative; height: 350px;">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Produk Terlaris -->
            <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    5 Produk Terlaris
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-700 dark:text-gray-200">
                        <thead>
                            <tr class="border-b dark:border-gray-600">
                                <th class="p-3">No.</th>
                                <th class="p-3">Nama Produk</th>
                                <th class="p-3">Jumlah Terjual</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($bestSellingProducts as $index => $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="p-3">{{ $index + 1 }}</td>
                                    <td class="p-3">
                                        {{ $item->product->name ?? 'Produk tidak ditemukan' }}
                                    </td>
                                    <td class="p-3">
                                        {{ $item->total_qty }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-3 text-center">
                                        Belum ada data penjualan produk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">
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
                                    <td class="p-3">
                                        {{ $transaction->invoice_number }}
                                    </td>
                                    <td class="p-3">
                                        {{ $transaction->user->name ?? '-' }}
                                    </td>
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

    <!-- Script Chart.js -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('salesChart');

            if (!canvas || !window.Chart) {
                console.error('Chart.js belum berhasil dimuat.');
                return;
            }

            new window.Chart(canvas, {
                type: 'line',
                data: {
                    labels: @json($trendLabels),
                    datasets: [{
                        label: 'Total Penjualan (Rupiah)',
                        data: @json($trendData),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.15)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush

</x-app-layout>
