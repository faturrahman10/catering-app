<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $startDate;
    protected $endDate;
    protected $status;
    protected $customerId;

    public function __construct($startDate, $endDate, $status = 'all', $customerId = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
        $this->customerId = $customerId;
    }

    public function collection()
    {
        $query = Order::with(['customer', 'items.menu'])->whereBetween('order_date', [$this->startDate, $this->endDate]);

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        if ($this->customerId) {
            $query->where('customer_id', $this->customerId);
        }

        return $query->latest('order_date')->get();
    }

    public function headings(): array
    {
        return ['No Order', 'Tanggal', 'Customer', 'Telepon', 'Status', 'Items', 'Total Harga', 'Notes'];
    }

    public function map($order): array
    {
        $items = $order->items
            ->map(function ($item) {
                return $item->menu->name . ' (x' . $item->qty . ')';
            })
            ->join(', ');

        $statusLabels = [
            'pending' => 'Pending',
            'confirmed' => 'Dikonfirmasi',
            'cooking' => 'Dimasak',
            'ready' => 'Siap',
            'delivered' => 'Terkirim',
            'canceled' => 'Dibatalkan',
        ];

        return ['#' . $order->id, $order->order_date->format('d-m-Y'), $order->customer->name, $order->customer->phone, $statusLabels[$order->status] ?? ucfirst($order->status), $items, 'Rp ' . number_format($order->total_price, 0, ',', '.'), $order->notes ?? '-'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'Laporan Order';
    }
}
