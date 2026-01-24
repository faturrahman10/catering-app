<?php

namespace App\Exports;

use App\Models\Income;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IncomesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Income::with('creator')
            ->whereBetween('income_date', [$this->startDate, $this->endDate])
            ->latest('income_date')
            ->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Sumber', 'Deskripsi', 'Jumlah', 'Total', 'Dibuat Oleh', 'Ada Bukti', 'Notes'];
    }

    public function map($income): array
    {
        $itemsText = collect($income->items)
            ->map(function ($item) {
                return $item['source'] . ': ' . $item['description'] . ' - Rp ' . number_format($item['amount'], 0, ',', '.');
            })
            ->join(' | ');

        return [$income->income_date->format('d-m-Y'), collect($income->items)->pluck('source')->unique()->join(', '), $itemsText, count($income->items) . ' item(s)', 'Rp ' . number_format($income->total_amount, 0, ',', '.'), $income->creator->name ?? '-', $income->proof_image ? 'Ya' : 'Tidak', $income->notes ?? '-'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'Pemasukan Lain';
    }
}
