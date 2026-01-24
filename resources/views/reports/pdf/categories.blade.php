<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Daftar Kategori</title>
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
            border-bottom: 2px solid #EC4899;
        }

        .header h1 {
            font-size: 18px;
            color: #EC4899;
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
            background-color: #FCE7F3;
        }

        .box-active {
            background-color: #D1FAE5;
        }

        .box-menus {
            background-color: #EEF2FF;
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
            background-color: #EC4899;
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
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <h1>LAPORAN DAFTAR KATEGORI</h1>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y') }}</p>
        @if ($status !== 'all')
            <p>Status: {{ $status === 'active' ? 'Aktif' : 'Non-aktif' }}</p>
        @endif
    </div>

    {{-- Summary Boxes --}}
    <div class="summary-boxes">
        <div class="summary-box box-total">
            <div class="summary-label">Total Kategori</div>
            <div class="summary-value" style="color: #EC4899;">{{ $categories->count() }}</div>
        </div>
        <div class="summary-box box-active">
            <div class="summary-label">Kategori Aktif</div>
            <div class="summary-value" style="color: #059669;">{{ $categories->where('is_active', 1)->count() }}</div>
        </div>
        <div class="summary-box box-menus">
            <div class="summary-label">Total Menu</div>
            <div class="summary-value" style="color: #6366F1;">{{ $categories->sum('menus_count') }}</div>
        </div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 40%;">Nama Kategori</th>
                <th style="width: 15%;" class="text-center">Status</th>
                <th style="width: 15%;" class="text-right">Jumlah Menu</th>
                <th style="width: 20%;">Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $index => $category)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-bold">{{ $category->name }}</td>
                    <td class="text-center">
                        @if ($category->is_active)
                            <span class="badge badge-active">Aktif</span>
                        @else
                            <span class="badge badge-inactive">Non-aktif</span>
                        @endif
                    </td>
                    <td class="text-right font-bold">{{ $category->menus_count }} menu</td>
                    <td>{{ $category->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Tidak ada data kategori</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }} WIB</p>
        <p>Laporan ini dibuat secara otomatis oleh sistem</p>
    </div>
</body>

</html>
