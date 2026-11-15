<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
public function collection(): \Illuminate\Support\Enumerable    {
        return Transaction::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'No. Invoice',
            'Tanggal',
            'Kasir',
            'Total',
            'Bayar',
            'Kembalian',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->invoice_number,
            $transaction->created_at,
            $transaction->user->name ?? '-',
            $transaction->total,
            $transaction->paid,
            $transaction->change,
        ];
    }
}
