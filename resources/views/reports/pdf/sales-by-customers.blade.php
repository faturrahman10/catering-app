<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan per Customer</title>
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
            border-bottom: 2px solid #8B5CF6;
        }

        .header h1 {
            font-size: 18px;
            color: #8B5CF6;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 10px;
            color: #666;
        }

        .summary-box {
            background-color: #EDE9FE;
            padding: 12px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 15px;
        }

        .summary-label {
            font-size: 9px;
            color: #5B21B6;
            margin-bottom: 3px;
        }

        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #7C3AED;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table thead {
            background-color: #8B5CF6;
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
        }

        .badge-active {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .badge-inactive {
            background-color: #F3F4F6;
            color: #6B7280;
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
            background-color: #EDE9FE !important;
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
        <h1>LAPORAN PENJUALAN PER CUSTOMER</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
    </div>

    {{-- Summary Box --}}
    <div class="summary-box">
        <div class="summary-label">Total Pendapatan dari Customer</div>
        <div class="summary-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Customer</th>
                <th style="width: 15%;">Telepon</th>
                <th style="width: 10%;" class="text-right">Total Order</th>
                <th style="width: 20%;" class="text-right">Total Belanja</th>
                <th style="width: 15%;">Order Terakhir</th>
                <th style="width: 10%;" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($salesByCustomer as $index => $customer)
                <tr class="{{ $index < 3 ? 'highlight-row' : '' }}">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-bold">{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td class="text-right font-bold">{{ $customer->total_orders }}</td>
                    <td class="text-right font-bold text-green">Rp
                        {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $customer->last_order_date ? $customer->last_order_date->format('d/m/Y') : '-' }}</td>
                    <td class="text-center">
                        @if ($customer->is_active)
                            <span class="badge badge-active">Aktif</span>
                        @else
                            <span class="badge badge-inactive">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 20px;">Tidak ada data penjualan</td>
                </tr>
            @endforelse

            @if ($salesByCustomer->isNotEmpty())
                <tr class="total-row">
                    <td colspan="4" class="text-right">TOTAL:</td>
                    <td class="text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                    <td colspan="2"></td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Notes --}}
    @if ($salesByCustomer->isNotEmpty())
        <div
            style="margin-top: 10px; padding: 8px; background-color: #FEF3C7; border-left: 3px solid #F59E0B; font-size: 8px;">
            <strong>Catatan:</strong> Baris dengan latar kuning menunjukkan 3 customer terbaik. Status "Aktif" untuk
            customer yang melakukan order dalam 30 hari terakhir.
        </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }} WIB</p>
        <p>Laporan ini dibuat secara otomatis oleh sistem</p>
    </div>
</body>

</html>
