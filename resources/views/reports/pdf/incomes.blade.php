<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pemasukan Lain</title>
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
            border-bottom: 2px solid #059669;
        }

        .header h1 {
            font-size: 18px;
            color: #059669;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 10px;
            color: #666;
        }

        .summary-box {
            background-color: #D1FAE5;
            padding: 12px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 15px;
        }

        .summary-label {
            font-size: 9px;
            color: #065F46;
            margin-bottom: 3px;
        }

        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #059669;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table thead {
            background-color: #059669;
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
            background-color: #D1FAE5;
            color: #065F46;
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
            background-color: #D1FAE5 !important;
            font-weight: bold;
        }

        .text-green {
            color: #059669;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <h1>LAPORAN PEMASUKAN LAIN</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
    </div>

    {{-- Summary Box --}}
    <div class="summary-box">
        <div class="summary-label">Total Pemasukan Lain</div>
        <div class="summary-value">Rp {{ number_format($totalIncomes, 0, ',', '.') }}</div>
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
            @forelse ($incomes as $income)
                <tr>
                    <td>{{ $income->income_date->format('d/m/Y') }}</td>
                    <td>
                        @foreach ($income->items as $item)
                            <div style="margin-bottom: 3px;">
                                <span class="badge">{{ $item['source'] }}</span>
                                <span>{{ $item['description'] }}</span>
                                <div class="item-detail">Rp {{ number_format($item['amount'], 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </td>
                    <td class="text-right">{{ count($income->items) }} item(s)</td>
                    <td class="text-right font-bold text-green">Rp
                        {{ number_format($income->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $income->creator->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Tidak ada data pemasukan lain</td>
                </tr>
            @endforelse

            @if ($incomes->isNotEmpty())
                <tr class="total-row">
                    <td colspan="3" class="text-right">TOTAL:</td>
                    <td class="text-right">Rp {{ number_format($totalIncomes, 0, ',', '.') }}</td>
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
