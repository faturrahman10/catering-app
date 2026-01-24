<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Daftar Customer</title>
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

        .summary-boxes {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .summary-box {
            flex: 1;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            margin-right: 10px;
        }

        .summary-box:last-child {
            margin-right: 0;
        }

        .box-total {
            background-color: #EDE9FE;
        }

        .box-active {
            background-color: #D1FAE5;
        }

        .box-orders {
            background-color: #DBEAFE;
        }

        .summary-label {
            font-size: 9px;
            color: #6B7280;
            margin-bottom: 3px;
        }

        .summary-value {
            font-size: 14px;
            font-weight: bold;
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

        .text-green {
            color: #059669;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <h1>LAPORAN DAFTAR CUSTOMER</h1>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y') }}</p>
    </div>

    {{-- Summary Boxes --}}
    <div class="summary-boxes">
        <div class="summary-box box-total">
            <div class="summary-label">Total Customer</div>
            <div class="summary-value" style="color: #8B5CF6;">{{ $customers->count() }}</div>
        </div>
        <div class="summary-box box-active">
            <div class="summary-label">Customer Aktif</div>
            <div class="summary-value" style="color: #059669;">{{ $customers->where('is_active', true)->count() }}</div>
        </div>
        <div class="summary-box box-orders">
            <div class="summary-label">Total Order</div>
            <div class="summary-value" style="color: #3B82F6;">{{ $customers->sum('total_orders') }}</div>
        </div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 22%;">Nama</th>
                <th style="width: 15%;">Telepon</th>
                <th style="width: 20%;">Alamat</th>
                <th style="width: 8%;" class="text-right">Order</th>
                <th style="width: 15%;" class="text-right">Belanja</th>
                <th style="width: 10%;" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $index => $customer)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-bold">{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td style="font-size: 8px;">
                        {{ $customer->address ? substr($customer->address, 0, 30) . '...' : '-' }}</td>
                    <td class="text-right font-bold">{{ $customer->total_orders }}</td>
                    <td class="text-right font-bold text-green">Rp
                        {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}</td>
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
                    <td colspan="7" class="text-center" style="padding: 20px;">Tidak ada data customer</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Notes --}}
    @if ($customers->isNotEmpty())
        <div
            style="margin-top: 10px; padding: 8px; background-color: #EEF2FF; border-left: 3px solid #6366F1; font-size: 8px;">
            <strong>Catatan:</strong> Status "Aktif" untuk customer yang melakukan order dalam 30 hari terakhir.
        </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }} WIB</p>
        <p>Laporan ini dibuat secara otomatis oleh sistem</p>
    </div>
</body>

</html>
