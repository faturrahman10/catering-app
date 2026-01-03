<x-app-layout>
    <div class="flex">

        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main Content --}}
        <div class="flex-1 p-6 bg-gray-100">
            <h1 class="text-2xl font-semibold mb-6">
                Dashboard Admin
            </h1>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Total Order</p>
                    <p class="text-2xl font-bold">{{ $totalOrders }}</p>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Order Hari Ini</p>
                    <p class="text-2xl font-bold">{{ $todayOrders }}</p>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Revenue</p>
                    <p class="text-2xl font-bold">
                        Rp {{ number_format($totalRevenue) }}
                    </p>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Menu Aktif</p>
                    <p class="text-2xl font-bold">{{ $activeMenus }}</p>
                </div>

            </div>

            {{-- Order Terbaru --}}
            <div class="bg-white rounded shadow p-4">
                <h2 class="font-semibold mb-4">Order Terbaru</h2>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Customer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestOrders as $order)
                            <tr class="border-b">
                                <td class="py-2">{{ $order->customer->name }}</td>
                                <td class="text-center">{{ $order->status }}</td>
                                <td class="text-center">
                                    Rp {{ number_format($order->total_price) }}
                                </td>
                                <td class="text-center">
                                    {{ $order->order_date }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
