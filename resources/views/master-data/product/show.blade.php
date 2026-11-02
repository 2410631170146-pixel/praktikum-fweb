<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Produk
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-xl font-bold">
                    {{ $product->name }}
                </h3>

                <p class="text-gray-500 mb-6">
                    {{ $product->code }} |
                    {{ $product->category->name ?? '-' }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                    <div class="bg-gray-100 p-4 rounded text-center">
                        <p class="text-gray-500">Harga</p>
                        <p class="font-bold text-lg">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-gray-100 p-4 rounded text-center">
                        <p class="text-gray-500">Stok Saat Ini</p>
                        <p class="font-bold text-lg">
                            {{ $product->stock }} {{ $product->unit }}
                        </p>
                    </div>

                    <div class="bg-gray-100 p-4 rounded text-center">
                        <p class="text-gray-500">Total Terjual</p>
                        <p class="font-bold text-lg">
                            {{ $totalTerjual }} {{ $product->unit }}
                        </p>
                    </div>

                </div>

                <h4 class="font-semibold text-lg mb-3">
                    Riwayat Penjualan Terakhir
                </h4>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3 text-left">No. Invoice</th>
                                <th class="border p-3 text-left">Tanggal</th>
                                <th class="border p-3 text-right">Qty</th>
                                <th class="border p-3 text-right">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($riwayat as $item)
                                <tr>
                                    <td class="border p-3">
                                        {{ $item->transaction->invoice_number }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $item->transaction->created_at->format('d-m-Y H:i') }}
                                    </td>

                                    <td class="border p-3 text-right">
                                        {{ $item->qty }}
                                    </td>

                                    <td class="border p-3 text-right">
                                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border p-4 text-center">
                                        Belum pernah terjual.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <a href="{{ route('products.index') }}"
                   class="inline-block mt-5 bg-gray-600 text-white px-4 py-2 rounded">
                    Kembali
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
<a href="{{ route('products.show', $product) }}"
   class="text-blue-600 hover:underline">
    Detail
</a>