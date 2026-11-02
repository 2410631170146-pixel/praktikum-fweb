<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'pay' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Keranjang masih kosong.',
            'items.min' => 'Pilih minimal satu produk.',
            'items.*.product_id.exists' => 'Produk tidak ditemukan.',
            'items.*.qty.min' => 'Jumlah produk minimal satu.',
            'pay.required' => 'Nominal pembayaran wajib diisi.',
        ];
    }
}