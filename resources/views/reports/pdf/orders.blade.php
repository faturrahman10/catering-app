<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Order</title>
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
            border-bottom: 2px solid #4F46E5;
        }

        .header h1 {
            font-size: 18px;
            color: #4F46E5;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 10px;
            color: #666;
        }

        .info-section {
            margin-bottom: 15px;
            background-color: #F3F4F6;
            padding: 10px;
            border-radius: 4px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .info-label {
            font-weight: bold;
            color: #374151;
        }

        .info-value {
            color: #6B7280;
        }

        .summary-boxes {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .summary-box {
            flex: 1;
            background-color: #EEF2FF;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            margin-right: 10px;
        }

        .summary-box:last-child {
            margin-right: 0;
        }

        .summary-label {
            font-size: 9px;
            color: #6B7280;
            margin-bottom: 3px;
        }

        .summary-value {
            font-size: 14px;
            font-weight: bold;
            color: #4F46E5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table thead {
            background-color: #4F46E5;
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

        .badge-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .badge-confirmed {
            background-color: #DBEAFE;
            color: #1E40AF;
        }

        .badge-cooking {
            background-color: #FED7AA;
            color: #9A3412;
        }

        .badge-ready {
            background-color: #E9D5FF;
            color: #6B21A8;
        }

        .badge-delivered {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .badge-canceled {
            background-color: #FEE2E2;
            color: #991B1B;
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
            background-color: #EEF2FF !important;
            font-weight: bold;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <h1>LAPORAN ORDER</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
        @if ($status !== 'all')
            <p>Status: {{ ucfirst($status) }}</p>
        @endif
    </div>

    {{-- Summary Boxes --}}
    <div class="summary-boxes">
        <div class="summary-box">
            <div class="summary-label">Total Order</div>
            <div class="summary-value">{{ $totalOrders }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-label">Total Nilai</div>
            <div class="summary-value">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th style="width: 8%;">No Order</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 20%;">Customer</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 30%;">Items</th>
                <th style="width: 15%;" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->order_date->format('d/m/Y') }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>
                        @php
                            $statusLabels = [
                                'pending' => 'Pending',
                                'confirmed' => 'Dikonfirmasi',
                                'cooking' => 'Dimasak',
                                'ready' => 'Siap',
                                'delivered' => 'Terkirim',
                                'canceled' => 'Dibatalkan',
                            ];
                            $badgeClass = 'badge-' . $order->status;
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        @foreach ($order->items as $item)
                            {{ $item->menu->name }} (x{{ $item->qty }}){{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td class="text-right font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Tidak ada data order</td>
                </tr>
            @endforelse

            @if ($orders->isNotEmpty())
                <tr class="total-row">
                    <td colspan="5" class="text-right">TOTAL:</td>
                    <td class="text-right">Rp {{ number_format($totalAmount, 0, ',', '.') }}</td>
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
