
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Struk Transaksi
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold">STRUK PEMBELIAN</h1>
                    <p class="text-gray-500">Point of Sale</p>
                </div>

                <hr class="mb-4">

                <div class="mb-4 space-y-1">
                    <p>
                        <strong>No. Invoice:</strong>
                        {{ $transaction->invoice_number }}
                    </p>
                    <p>
                        <strong>Tanggal:</strong>
                        {{ $transaction->created_at->format('d-m-Y H:i') }}
                    </p>
                    <p>
                        <strong>Kasir:</strong>
                        {{ $transaction->user->name ?? '-' }}
                    </p>
                </div>

                <hr class="mb-4">

                <table class="w-full mb-5">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Produk</th>
                            <th class="text-center py-2">Qty</th>
                            <th class="text-right py-2">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transaction->details as $detail)
                            <tr class="border-b">
                                <td class="py-2">
                                    {{ $detail->product->name ?? 'Produk dihapus' }}
                                    <div class="text-sm text-gray-500">
                                        Rp {{ number_format($detail->price, 0, ',', '.') }}
                                    </div>
                                </td>

                                <td class="text-center py-2">
                                    {{ $detail->qty }}
                                </td>

                                <td class="text-right py-2">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="space-y-2 border-t pt-4">
                    <div class="flex justify-between">
                        <span>Total</span>
                        <strong>
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                        </strong>
                    </div>

                    <div class="flex justify-between">
                        <span>Uang Bayar</span>
                        <span>
                            Rp {{ number_format($transaction->pay, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Kembalian</span>
                        <strong>
                            Rp {{ number_format($transaction->change, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>

                <div class="text-center mt-8">
                    <p class="font-semibold">Terima kasih telah berbelanja!</p>
                </div>

                <div class="flex justify-center gap-3 mt-6">
                    <a href="{{ route('pos.index') }}"
                       class="bg-gray-800 text-white px-4 py-2 rounded">
                        Kembali ke POS
                    </a>

                    <button onclick="window.print()"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                        Cetak Struk
                    </button>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
