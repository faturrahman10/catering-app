<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesByMenuExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $startDate;
    protected $endDate;
    protected $categoryId;
    protected $totalRevenue;

    public function __construct($startDate, $endDate, $categoryId = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->categoryId = $categoryId;
    }

    public function collection()
    {
        $query = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('categories', 'menus.category_id', '=', 'categories.id')
            ->where('orders.status', 'delivered')
            ->whereBetween('orders.order_date', [$this->startDate, $this->endDate])
            ->select('menus.name as menu_name', 'categories.name as category_name', 'menus.price', DB::raw('SUM(order_items.qty) as total_qty'), DB::raw('SUM(order_items.subtotal) as total_revenue'))
            ->groupBy('menus.name', 'categories.name', 'menus.price');

        if ($this->categoryId) {
            $query->where('menus.category_id', $this->categoryId);
        }

        $data = $query->orderByDesc('total_revenue')->get();

        $this->totalRevenue = $data->sum('total_revenue');

        return $data;
    }

    public function headings(): array
    {
        return ['Nama Menu', 'Kategori', 'Harga Satuan', 'Qty Terjual', 'Total Pendapatan', 'Persentase (%)'];
    }

    public function map($item): array
    {
        $percentage = $this->totalRevenue > 0 ? ($item->total_revenue / $this->totalRevenue) * 100 : 0;

        return [$item->menu_name, $item->category_name, 'Rp ' . number_format($item->price, 0, ',', '.'), $item->total_qty, 'Rp ' . number_format($item->total_revenue, 0, ',', '.'), number_format($percentage, 2) . '%'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'Penjualan per Menu';
    }
}
