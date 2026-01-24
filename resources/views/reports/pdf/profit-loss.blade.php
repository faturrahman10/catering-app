<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Laba Rugi</title>
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

        .section {
            margin-bottom: 20px;
            border: 1px solid #E5E7EB;
            border-radius: 4px;
            overflow: hidden;
        }

        .section-header {
            padding: 8px 12px;
            font-weight: bold;
            font-size: 11px;
        }

        .section-revenue {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .section-expense {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .section-profit {
            background-color: #DBEAFE;
            color: #1E40AF;
        }

        .section-loss {
            background-color: #FED7AA;
            color: #9A3412;
        }

        .section-body {
            padding: 10px 12px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #F3F4F6;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-label {
            color: #6B7280;
            font-size: 9px;
        }

        .item-value {
            font-weight: bold;
            font-size: 9px;
        }

        .total-row {
            background-color: #F9FAFB;
            padding: 8px 12px;
            margin-top: 5px;
            border-top: 2px solid #E5E7EB;
        }

        .total-label {
            font-weight: bold;
            font-size: 10px;
        }

        .total-value {
            font-weight: bold;
            font-size: 11px;
        }

        .summary-box {
            padding: 15px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 20px;
        }

        .summary-box-profit {
            background-color: #DBEAFE;
            border: 2px solid #3B82F6;
        }

        .summary-box-loss {
            background-color: #FED7AA;
            border: 2px solid #F97316;
        }

        .summary-label {
            font-size: 10px;
            margin-bottom: 5px;
        }

        .summary-value {
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #E5E7EB;
            text-align: center;
            font-size: 8px;
            color: #9CA3AF;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <h1>LAPORAN LABA RUGI</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
    </div>

    {{-- Revenue Section --}}
    <div class="section">
        <div class="section-header section-revenue">PEMASUKAN</div>
        <div class="section-body">
            <div class="item-row">
                <span class="item-label">Penjualan Orders (Delivered)</span>
                <span class="item-value">Rp {{ number_format($ordersRevenue, 0, ',', '.') }}</span>
            </div>
            <div class="item-row">
                <span class="item-label">Pemasukan Lain</span>
                <span class="item-value">Rp {{ number_format($otherIncome, 0, ',', '.') }}</span>
            </div>
            <div class="total-row" style="display: flex; justify-content: space-between;">
                <span class="total-label" style="color: #059669;">TOTAL PEMASUKAN</span>
                <span class="total-value" style="color: #059669;">Rp
                    {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Expense Section --}}
    <div class="section">
        <div class="section-header section-expense">PENGELUARAN</div>
        <div class="section-body">
            @forelse ($expensesByCategory as $expense)
                <div class="item-row">
                    <span class="item-label">{{ $expense['category'] }}</span>
                    <span class="item-value">Rp {{ number_format($expense['total'], 0, ',', '.') }}</span>
                </div>
            @empty
                <div class="item-row">
                    <span class="item-label">Tidak ada pengeluaran</span>
                    <span class="item-value">Rp 0</span>
                </div>
            @endforelse
            <div class="total-row" style="display: flex; justify-content: space-between;">
                <span class="total-label" style="color: #DC2626;">TOTAL PENGELUARAN</span>
                <span class="total-value" style="color: #DC2626;">Rp
                    {{ number_format($totalExpenses, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Profit/Loss Summary --}}
    <div class="summary-box {{ $profit >= 0 ? 'summary-box-profit' : 'summary-box-loss' }}">
        <div class="summary-label" style="color: {{ $profit >= 0 ? '#1E40AF' : '#9A3412' }};">
            {{ $profit >= 0 ? 'LABA BERSIH' : 'RUGI BERSIH' }}
        </div>
        <div class="summary-value" style="color: {{ $profit >= 0 ? '#3B82F6' : '#F97316' }};">
            Rp {{ number_format(abs($profit), 0, ',', '.') }}
        </div>
    </div>

    {{-- Calculation Detail --}}
    <div style="background-color: #F9FAFB; padding: 10px; border-radius: 4px; font-size: 9px;">
        <strong>Perhitungan:</strong><br>
        Total Pemasukan: Rp {{ number_format($totalRevenue, 0, ',', '.') }}<br>
        Total Pengeluaran: Rp {{ number_format($totalExpenses, 0, ',', '.') }}<br>
        {{ $profit >= 0 ? 'Laba' : 'Rugi' }}: Rp {{ number_format(abs($profit), 0, ',', '.') }}
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }} WIB</p>
        <p>Laporan ini dibuat secara otomatis oleh sistem</p>
    </div>
</body>

</html>
