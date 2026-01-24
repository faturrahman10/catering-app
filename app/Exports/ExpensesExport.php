<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExpensesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $startDate;
    protected $endDate;
    protected $category;

    public function __construct($startDate, $endDate, $category = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->category = $category;
    }

    public function collection()
    {
        $query = Expense::with('creator')->whereBetween('expense_date', [$this->startDate, $this->endDate]);

        if ($this->category) {
            $query->whereJsonContains('items', [['category' => $this->category]]);
        }

        return $query->latest('expense_date')->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Kategori', 'Deskripsi', 'Jumlah', 'Total', 'Dibuat Oleh', 'Ada Bukti', 'Notes'];
    }

    public function map($expense): array
    {
        $itemsText = collect($expense->items)
            ->map(function ($item) {
                return $item['category'] . ': ' . $item['description'] . ' - Rp ' . number_format($item['amount'], 0, ',', '.');
            })
            ->join(' | ');

        return [$expense->expense_date->format('d-m-Y'), collect($expense->items)->pluck('category')->unique()->join(', '), $itemsText, count($expense->items) . ' item(s)', 'Rp ' . number_format($expense->total_amount, 0, ',', '.'), $expense->creator->name ?? '-', $expense->receipt_image ? 'Ya' : 'Tidak', $expense->notes ?? '-'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'Pengeluaran';
    }
}
