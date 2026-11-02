<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Http\Requests\StorePosRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)
            ->orderBy('name')
            ->get([
                'id',
                'code',
                'name',
                'price',
                'stock',
                'unit'
            ]);

        return view('pos.index', compact('products'));
    }

    public function store(StorePosRequest $request)
    {
        try {
            $transaction = DB::transaction(function () use ($request) {

                $total = 0;
                $details = [];

                foreach ($request->items as $item) {

                    $product = Product::lockForUpdate()
                        ->findOrFail($item['product_id']);

                    if ($product->stock < $item['qty']) {
                        throw new Exception(
                            "Stok {$product->name} tidak mencukupi."
                        );
                    }

                    $subtotal = $product->price * $item['qty'];

                    $total += $subtotal;

                    $details[] = [
                        'product_id' => $product->id,
                        'qty' => $item['qty'],
                        'price' => $product->price,
                        'subtotal' => $subtotal,
                    ];

                    $product->decrement('stock', $item['qty']);
                }

                if ($request->pay < $total) {
                    throw new Exception(
                        'Pembayaran kurang dari total belanja.'
                    );
                }

                $trx = Transaction::create([
                    'invoice_number' => 'INV-' .
                        now()->format('YmdHis') . '-' .
                        Str::upper(Str::random(5)),
                    'user_id' => auth()->id(),
                    'total' => $total,
                    'pay' => $request->pay,
                    'change' => $request->pay - $total,
                ]);

                $trx->details()->createMany($details);

                return $trx;
            });

            return redirect()
                ->route('pos.struk', $transaction)
                ->with('success', 'Transaksi berhasil disimpan.');

        } catch (Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function struk(Transaction $transaction)
    {
        $transaction->load('details.product', 'user');

        return view('pos.struk', compact('transaction'));
    }

    public function riwayatSaya()
    {
        $transaksi = Transaction::where('user_id', auth()->id())
            ->with('details.product')
            ->latest()
            ->get();

        return view('pos.riwayat', compact('transaksi'));
    }
}