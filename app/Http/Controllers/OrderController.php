<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $menus = Menu::where('is_active', true)->get();

        return view('orders.create', compact('customers', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            // 3️⃣ BUAT ORDER UTAMA
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'order_date' => $request->order_date,
                'status' => 'pending',
                'total_price' => 0,
            ]);

            $total = 0;

            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['menu_id']);

                $price = $menu->price;
                $qty = $item['qty'];
                $subtotal = $price * $qty;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'qty' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $order->update([
                'total_price' => $total,
            ]);
        });

        return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat');
    }

    public function show(Order $order)
    {
        $order->load('customer', 'items.menu');
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cooking,ready,delivered,canceled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status order diperbarui');
    }
}
