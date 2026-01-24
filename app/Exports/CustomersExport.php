<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    public function collection()
    {
        return Customer::withCount([
            'orders as total_orders' => function ($query) {
                $query->where('status', 'delivered');
            },
        ])
            ->withSum(
                [
                    'orders as total_spent' => function ($query) {
                        $query->where('status', 'delivered');
                    },
                ],
                'total_price',
            )
            ->with([
                'orders' => function ($query) {
                    $query->where('status', 'delivered')->latest('order_date')->limit(1);
                },
            ])
            ->orderBy('name')
            ->get();
    }

    public function headings(): array
    {
        return ['Nama', 'Telepon', 'Alamat', 'Tanggal Daftar', 'Total Order', 'Total Belanja', 'Order Terakhir', 'Status'];
    }

    public function map($customer): array
    {
        $lastOrderDate = $customer->orders->first()?->order_date;
        $isActive = $lastOrderDate && $lastOrderDate->isAfter(now()->subDays(30));

        return [$customer->name, $customer->phone, $customer->address ?? '-', $customer->created_at->format('d-m-Y'), $customer->total_orders, 'Rp ' . number_format($customer->total_spent ?? 0, 0, ',', '.'), $lastOrderDate ? $lastOrderDate->format('d-m-Y') : '-', $isActive ? 'Aktif' : 'Tidak Aktif'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Customer';
    }
}
