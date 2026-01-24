<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoriesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $status;

    public function __construct($status = 'all')
    {
        $this->status = $status;
    }

    public function collection()
    {
        $query = Category::withCount('menus');

        if ($this->status !== 'all') {
            $query->where('is_active', $this->status === 'active' ? 1 : 0);
        }

        return $query->orderBy('name')->get();
    }

    public function headings(): array
    {
        return ['Nama Kategori', 'Status', 'Jumlah Menu', 'Tanggal Dibuat'];
    }

    public function map($category): array
    {
        return [$category->name, $category->is_active ? 'Aktif' : 'Non-aktif', $category->menus_count, $category->created_at->format('d-m-Y')];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'Daftar Kategori';
    }
}
