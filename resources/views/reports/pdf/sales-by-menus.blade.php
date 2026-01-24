<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan per Menu</title>
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
            border-bottom: 2px solid #10B981;
        }

        .header h1 {
            font-size: 18px;
            color: #10B981;
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
            background-color: #10B981;
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
            font-size: 8px;
            font-weight: bold;
            background-color: #DBEAFE;
            color: #1E40AF;
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

        .highlight-row {
            background-color: #FEF3C7 !important;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <h1>LAPORAN PENJUALAN PER MENU</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
    </div>

    {{-- Summary Box --}}
    <div class="summary-box">
        <div class="summary-label">Total Pendapatan dari Menu</div>
        <div class="summary-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Nama Menu</th>
                <th style="width: 20%;">Kategori</th>
                <th style="width: 15%;" class="text-right">Harga</th>
                <th style="width: 10%;" class="text-right">Qty</th>
                <th style="width: 15%;" class="text-right">Total</th>
                <th style="width: 5%;" class="text-right">%</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($salesByMenu as $index => $item)
                <tr class="{{ $index < 3 ? 'highlight-row' : '' }}">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-bold">{{ $item->menu_name }}</td>
                    <td>
                        <span class="badge">{{ $item->category_name }}</span>
                    </td>
                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-right font-bold">{{ $item->total_qty }}</td>
                    <td class="text-right font-bold text-green">Rp
                        {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($item->percentage, 1) }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 20px;">Tidak ada data penjualan</td>
                </tr>
            @endforelse

            @if ($salesByMenu->isNotEmpty())
                <tr class="total-row">
                    <td colspan="5" class="text-right">TOTAL:</td>
                    <td class="text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                    <td class="text-right">100%</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Notes --}}
    @if ($salesByMenu->isNotEmpty())
        <div
            style="margin-top: 10px; padding: 8px; background-color: #FEF3C7; border-left: 3px solid #F59E0B; font-size: 8px;">
            <strong>Catatan:</strong> Baris dengan latar kuning menunjukkan 3 menu terlaris
        </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }} WIB</p>
        <p>Laporan ini dibuat secara otomatis oleh sistem</p>
    </div>
</body>

</html>
