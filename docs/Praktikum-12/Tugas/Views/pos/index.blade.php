
<x-app-layout>
    <div class="max-w-7xl mx-auto p-6"
         x-data="posCart(@js($products))">

        <h1 class="text-2xl font-bold mb-6">
            Point of Sale (Kasir)
        </h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- DAFTAR PRODUK -->
            <div class="md:col-span-2 bg-white p-5 rounded shadow">

                <h2 class="text-lg font-semibold mb-4">
                    Daftar Produk
                </h2>

                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari nama produk..."
                    class="w-full border rounded p-2 mb-4"
                >

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    <template x-for="product in filteredProducts" :key="product.id">
                        <button
                            type="button"
                            @click="addProduct(product)"
                            class="border rounded-lg p-4 text-left hover:bg-gray-100"
                        >
                            <h3 class="font-semibold" x-text="product.name"></h3>

                            <p class="text-sm text-gray-500"
                               x-text="product.code"></p>

                            <p class="font-bold text-blue-600 mt-2"
                               x-text="formatRupiah(product.price)"></p>

                            <p class="text-sm text-gray-500"
                               x-text="'Stok: ' + product.stock + ' ' + product.unit"></p>
                        </button>
                    </template>

                </div>

                <p x-show="filteredProducts.length === 0"
                   class="text-gray-500 mt-4">
                    Produk tidak ditemukan.
                </p>
            </div>

            <!-- KERANJANG -->
            <div class="bg-white p-5 rounded shadow">

                <h2 class="text-lg font-semibold mb-4">
                    Keranjang Belanja
                </h2>

                <template x-if="cart.length === 0">
                    <p class="text-gray-500">
                        Belum ada produk dipilih.
                    </p>
                </template>

                <div class="space-y-4">

                    <template x-for="(item, index) in cart" :key="item.product_id">

                        <div class="border-b pb-3">

                            <div class="flex justify-between">
                                <p class="font-semibold" x-text="item.name"></p>

                                <button
                                    type="button"
                                    @click="removeProduct(index)"
                                    class="text-red-600">
                                    Hapus
                                </button>
                            </div>

                            <p class="text-sm text-gray-500"
                               x-text="formatRupiah(item.price)">
                            </p>

                            <div class="flex items-center gap-3 mt-2">

                                <button
                                    type="button"
                                    @click="decreaseQty(index)"
                                    class="border px-3 py-1 rounded">
                                    -
                                </button>

                                <span x-text="item.qty"></span>

                                <button
                                    type="button"
                                    @click="increaseQty(index)"
                                    class="border px-3 py-1 rounded">
                                    +
                                </button>

                            </div>

                            <p class="font-semibold mt-2"
                               x-text="formatRupiah(item.price * item.qty)">
                            </p>

                            <input
                                type="hidden"
                                :name="'items[' + index + '][product_id]'"
                                :value="item.product_id">

                            <input
                                type="hidden"
                                :name="'items[' + index + '][qty]'"
                                :value="item.qty">

                        </div>

                    </template>

                </div>

                <div class="border-t mt-4 pt-4">

                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span x-text="formatRupiah(total)"></span>
                    </div>

                    <form action="{{ route('pos.store') }}" method="POST" class="mt-4">
                        @csrf

                        <template x-for="(item, index) in cart" :key="item.product_id">
                            <div>
                                <input
                                    type="hidden"
                                    :name="'items[' + index + '][product_id]'"
                                    :value="item.product_id">

                                <input
                                    type="hidden"
                                    :name="'items[' + index + '][qty]'"
                                    :value="item.qty">
                            </div>
                        </template>

                        <label class="block font-medium mb-2">
                            Nominal Pembayaran
                        </label>

                        <input
                            type="number"
                            name="pay"
                            x-model.number="pay"
                            min="0"
                            required
                            class="w-full border rounded p-2"
                            placeholder="Masukkan jumlah pembayaran"
                        >

                        <div class="flex justify-between mt-3">
                            <span>Kembalian</span>
                            <span class="font-bold"
                                  x-text="formatRupiah(change)"></span>
                        </div>

                        <button
                            type="submit"
                            :disabled="cart.length === 0 || pay < total"
                            class="w-full mt-5 bg-blue-600 text-white rounded p-3
                                   disabled:bg-gray-400">
                            Simpan Transaksi
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>

    <script>
        function posCart(products) {
            return {
                products: products,
                cart: [],
                search: '',
                pay: 0,

                get filteredProducts() {
                    return this.products.filter(product =>
                        product.name.toLowerCase().includes(
                            this.search.toLowerCase()
                        )
                    );
                },

                get total() {
                    return this.cart.reduce(
                        (sum, item) => sum + (item.price * item.qty), 0
                    );
                },

                get change() {
                    return Math.max(this.pay - this.total, 0);
                },

                formatRupiah(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        maximumFractionDigits: 0
                    }).format(value);
                },

                addProduct(product) {
                    const item = this.cart.find(
                        item => item.product_id === product.id
                    );

                    if (item) {
                        this.increaseQty(this.cart.indexOf(item));
                        return;
                    }

                    this.cart.push({
                        product_id: product.id,
                        name: product.name,
                        price: Number(product.price),
                        stock: Number(product.stock),
                        qty: 1
                    });
                },

                increaseQty(index) {
                    if (this.cart[index].qty < this.cart[index].stock) {
                        this.cart[index].qty++;
                    }
                },

                decreaseQty(index) {
                    if (this.cart[index].qty > 1) {
                        this.cart[index].qty--;
                    } else {
                        this.removeProduct(index);
                    }
                },

                removeProduct(index) {
                    this.cart.splice(index, 1);
                }
            };
        }
    </script>
</x-app-layout>
