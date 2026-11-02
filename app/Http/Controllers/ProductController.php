<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('master-data.product.index', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('master-data.product.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:products,code',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan detail produk
    public function show(Product $product)
    {
        $product->load([
            'category',
            'transactionDetails.transaction'
        ]);

        $totalTerjual = $product->transactionDetails->sum('qty');

        $riwayat = $product->transactionDetails()
            ->with('transaction')
            ->latest()
            ->take(10)
            ->get();

        return view(
            'master-data.product.show',
            compact('product', 'totalTerjual', 'riwayat')
        );
    }

    // Menampilkan form edit produk
    public function edit(Product $product)
    {
        return view('master-data.product.edit', compact('product'));
    }

    // Memperbarui produk
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'code' => 'required|unique:products,code,' . $product->id,
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
