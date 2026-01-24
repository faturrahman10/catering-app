<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pengeluaran</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #DC2626;
        }

        .header h1 {
            font-size: 18px;
            color: #DC2626;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 10px;
            color: #666;
        }

        .summary-box {
            background-color: #FEE2E2;
            padding: 12px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 15px;
        }

        .summary-label {
            font-size: 9px;
            color: #991B1B;
            margin-bottom: 3px;
        }

        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #DC2626;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table thead {
            background-color: #DC2626;
            color: white;
        }

        table thead th {
            padding: 8px 6px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
        }

        table tbody td {
            padding: 6px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 9px;
        }

        table tbody tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 7px;
            font-weight: bold;
            background-color: #DBEAFE;
            color: #1E40AF;
            margin-right: 3px;
        }

        .item-detail {
            font-size: 8px;
            color: #6B7280;
            margin-top: 2px;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #E5E7EB;
            text-align: center;
            font-size: 8px;
            color: #9CA3AF;
        }

        .font-bold {
            font-weight: bold;
        }

        .total-row {
            background-color: #FEE2E2 !important;
            font-weight: bold;
        }

        .text-red {
            color: #DC2626;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <h1>LAPORAN PENGELUARAN</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
        @if ($category)
            <p>Kategori: {{ $category }}</p>
        @endif
    </div>

    {{-- Summary Box --}}
    <div class="summary-box">
        <div class="summary-label">Total Pengeluaran</div>
        <div class="summary-value">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 45%;">Detail Items</th>
                <th style="width: 8%;" class="text-right">Jumlah</th>
                <th style="width: 18%;" class="text-right">Total</th>
                <th style="width: 17%;">Dibuat Oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenses as $expense)
                <tr>
                    <td>{{ $expense->expense_date->format('d/m/Y') }}</td>
                    <td>
                        @foreach ($expense->items as $item)
                            <div style="margin-bottom: 3px;">
                                <span class="badge">{{ $item['category'] }}</span>
                                <span>{{ $item['description'] }}</span>
                                <div class="item-detail">Rp {{ number_format($item['amount'], 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </td>
                    <td class="text-right">{{ count($expense->items) }} item(s)</td>
                    <td class="text-right font-bold text-red">Rp
                        {{ number_format($expense->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $expense->creator->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Tidak ada data pengeluaran</td>
                </tr>
            @endforelse

            @if ($expenses->isNotEmpty())
                <tr class="total-row">
                    <td colspan="3" class="text-right">TOTAL:</td>
                    <td class="text-right">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }} WIB</p>
        <p>Laporan ini dibuat secara otomatis oleh sistem</p>
    </div>
</body>

</html>
