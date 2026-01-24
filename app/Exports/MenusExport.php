<?php

namespace App\Exports;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MenusExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $status;
    protected $categoryId;

    public function __construct($status = 'all', $categoryId = null)
    {
        $this->status = $status;
        $this->categoryId = $categoryId;
    }

    public function collection()
    {
        $query = Menu::with('category');

        if ($this->status !== 'all') {
            $query->where('is_active', $this->status === 'active' ? 1 : 0);
        }

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }

        return $query
            ->withCount([
                'orderItems as total_sold' => function ($query) {
                    $query->join('orders', 'order_items.order_id', '=', 'orders.id')->where('orders.status', 'delivered')->select(DB::raw('SUM(order_items.qty)'));
                },
            ])
            ->orderBy('name')
            ->get();
    }

    public function headings(): array
    {
        return ['Nama Menu', 'Kategori', 'Harga', 'Status', 'Total Terjual', 'Deskripsi'];
    }

    public function map($menu): array
    {
        return [$menu->name, $menu->category->name, 'Rp ' . number_format($menu->price, 0, ',', '.'), $menu->is_active ? 'Aktif' : 'Non-aktif', $menu->total_sold ?? 0, $menu->description ?? '-'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Menu';
    }
}
