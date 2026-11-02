 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Transaksi Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">
                    Daftar Riwayat Transaksi
                </h3>

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($transaksi->isEmpty())
                    <p class="text-gray-600">
                        Belum ada transaksi yang tercatat.
                    </p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-3 text-left">No.</th>
                                    <th class="border p-3 text-left">Invoice</th>
                                    <th class="border p-3 text-left">Tanggal</th>
                                    <th class="border p-3 text-right">Total</th>
                                    <th class="border p-3 text-center">Detail</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($transaksi as $index => $item)
                                    <tr>
                                        <td class="border p-3">
                                            {{ $index + 1 }}
                                        </td>

                                        <td class="border p-3">
                                            {{ $item->invoice_number }}
                                        </td>

                                        <td class="border p-3">
                                            {{ $item->created_at->format('d-m-Y H:i') }}
                                        </td>

                                        <td class="border p-3 text-right">
                                            Rp {{ number_format($item->total, 0, ',', '.') }}
                                        </td>

                                        <td class="border p-3 text-center">
                                            <a href="{{ route('pos.struk', $item) }}"
                                               class="text-blue-600 hover:underline">
                                                Lihat Struk
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('pos.index') }}"
                       class="bg-gray-800 text-white px-4 py-2 rounded">
                        Kembali ke POS
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>