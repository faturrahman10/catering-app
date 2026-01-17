<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount('orders')->latest()->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan');
    }

    public function show(Customer $customer)
    {
        $customer->load('orders');
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Customer berhasil diperbarui');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->orders()->exists()) {
            return back()->with('error', 'Customer tidak dapat dihapus karena memiliki order');
        }

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus');
    }
}
