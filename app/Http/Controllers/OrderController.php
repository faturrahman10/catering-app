<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->latest()->paginate(15);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $menus = Menu::where('is_active', true)->orderBy('name')->get();

        return view('orders.create', compact('customers', 'menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'order_date' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_id' => ['required', 'exists:menus,id'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $order = Order::create([
                    'customer_id' => $validated['customer_id'],
                    'order_date' => $validated['order_date'],
                    'status' => 'pending',
                    'notes' => $validated['notes'] ?? null,
                    'total_price' => 0,
                ]);

                $total = 0;

                $menus = Menu::whereIn('id', collect($validated['items'])->pluck('menu_id'))
                    ->get()
                    ->keyBy('id');

                foreach ($validated['items'] as $item) {
                    $menu = $menus[$item['menu_id']];

                    $price = $menu->price;
                    $qty = $item['qty'];
                    $subtotal = $price * $qty;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'menu_id' => $menu->id,
                        'price' => $price,
                        'qty' => $qty,
                        'subtotal' => $subtotal,
                    ]);

                    $total += $subtotal;
                }

                $order->update([
                    'total_price' => $total,
                ]);
            });
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan order. Silakan coba lagi.');
        }

        return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'items.menu']);

        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'confirmed', 'cooking', 'ready', 'delivered', 'canceled'])],
        ]);

        if ($order->status === 'canceled') {
            return back()->with('error', 'Order yang sudah dibatalkan tidak dapat diubah.');
        }

        $order->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status order berhasil diperbarui');
    }

    public function destroy(Order $order)
    {
        try {
            DB::transaction(function () use ($order) {
                $order->items()->delete();
                $order->delete();
            });
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Gagal menghapus order.');
        }

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }
}
