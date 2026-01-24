<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Daftar Menu</title>
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
            border-bottom: 2px solid #6366F1;
        }

        .header h1 {
            font-size: 18px;
            color: #6366F1;
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
            background-color: #EEF2FF;
        }

        .box-active {
            background-color: #D1FAE5;
        }

        .box-inactive {
            background-color: #F3F4F6;
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
            background-color: #6366F1;
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

        .badge-category {
            background-color: #DBEAFE;
            color: #1E40AF;
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
        <h1>LAPORAN DAFTAR MENU</h1>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y') }}</p>
        @if ($status !== 'all')
            <p>Status: {{ $status === 'active' ? 'Aktif' : 'Non-aktif' }}</p>
        @endif
    </div>

    {{-- Summary Boxes --}}
    <div class="summary-boxes">
        <div class="summary-box box-total">
            <div class="summary-label">Total Menu</div>
            <div class="summary-value" style="color: #6366F1;">{{ $menus->count() }}</div>
        </div>
        <div class="summary-box box-active">
            <div class="summary-label">Menu Aktif</div>
            <div class="summary-value" style="color: #059669;">{{ $menus->where('is_active', 1)->count() }}</div>
        </div>
        <div class="summary-box box-inactive">
            <div class="summary-label">Menu Non-aktif</div>
            <div class="summary-value" style="color: #6B7280;">{{ $menus->where('is_active', 0)->count() }}</div>
        </div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Nama Menu</th>
                <th style="width: 20%;">Kategori</th>
                <th style="width: 15%;" class="text-right">Harga</th>
                <th style="width: 10%;" class="text-right">Terjual</th>
                <th style="width: 10%;" class="text-center">Status</th>
                <th style="width: 10%;">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $index => $menu)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-bold">{{ $menu->name }}</td>
                    <td>
                        <span class="badge badge-category">{{ $menu->category->name }}</span>
                    </td>
                    <td class="text-right">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td class="text-right font-bold">{{ $menu->total_sold ?? 0 }}</td>
                    <td class="text-center">
                        @if ($menu->is_active)
                            <span class="badge badge-active">Aktif</span>
                        @else
                            <span class="badge badge-inactive">Non-aktif</span>
                        @endif
                    </td>
                    <td style="font-size: 7px;">
                        {{ $menu->description ? substr($menu->description, 0, 30) . '...' : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 20px;">Tidak ada data menu</td>
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
