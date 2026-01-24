<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Expense;
use App\Models\Income;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class ProfitLossExport implements FromCollection, WithHeadings, WithStyles, WithTitle
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
        $ordersRevenue = Order::where('status', 'delivered')
            ->whereBetween('order_date', [$this->startDate, $this->endDate])
            ->sum('total_price');

        $otherIncome = Income::whereBetween('income_date', [$this->startDate, $this->endDate])->sum('total_amount');

        $totalRevenue = $ordersRevenue + $otherIncome;

        $expenses = Expense::whereBetween('expense_date', [$this->startDate, $this->endDate])->get();

        $expensesByCategory = [];
        $totalExpenses = 0;

        foreach ($expenses as $expense) {
            foreach ($expense->items as $item) {
                $category = $item['category'];
                if (!isset($expensesByCategory[$category])) {
                    $expensesByCategory[$category] = 0;
                }
                $expensesByCategory[$category] += $item['amount'];
                $totalExpenses += $item['amount'];
            }
        }

        $profit = $totalRevenue - $totalExpenses;

        // Build collection for Excel
        $data = collect();

        // Revenue Section
        $data->push(['PEMASUKAN', '']);
        $data->push(['Penjualan Orders', 'Rp ' . number_format($ordersRevenue, 0, ',', '.')]);
        $data->push(['Pemasukan Lain', 'Rp ' . number_format($otherIncome, 0, ',', '.')]);
        $data->push(['TOTAL PEMASUKAN', 'Rp ' . number_format($totalRevenue, 0, ',', '.')]);
        $data->push(['', '']);

        // Expenses Section
        $data->push(['PENGELUARAN', '']);
        foreach ($expensesByCategory as $category => $amount) {
            $data->push([$category, 'Rp ' . number_format($amount, 0, ',', '.')]);
        }
        $data->push(['TOTAL PENGELUARAN', 'Rp ' . number_format($totalExpenses, 0, ',', '.')]);
        $data->push(['', '']);

        // Profit/Loss
        $data->push(['LABA/RUGI BERSIH', 'Rp ' . number_format($profit, 0, ',', '.')]);

        return $data;
    }

    public function headings(): array
    {
        return ['Keterangan', 'Jumlah'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
            'A:B' => ['font' => ['size' => 11]],
        ];
    }

    public function title(): string
    {
        return 'Laba Rugi';
    }
}
