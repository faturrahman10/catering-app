<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $category = $request->input('category');

        $query = Expense::with('creator')->whereBetween('expense_date', [$startDate, $endDate]);

        if ($category) {
            $query->whereJsonContains('items', [['category' => $category]]);
        }

        $expenses = $query->latest('expense_date')->paginate(15);

        $totalExpenses = Expense::whereBetween('expense_date', [$startDate, $endDate])->sum('total_amount');

        // Get unique categories untuk filter
        $categories = ['Bahan Makanan', 'Alat Dapur', 'Gaji Karyawan', 'Utilitas (Listrik, Air, Gas)', 'Transportasi', 'Sewa Tempat', 'Lainnya'];

        return view('finance.expenses.index', compact('expenses', 'totalExpenses', 'startDate', 'endDate', 'categories', 'category'));
    }

    public function create()
    {
        $categories = ['Bahan Makanan', 'Alat Dapur', 'Gaji Karyawan', 'Utilitas (Listrik, Air, Gas)', 'Transportasi', 'Sewa Tempat', 'Lainnya'];

        return view('finance.expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_date' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.category' => ['required', 'string', 'max:255'],
            'items.*.description' => ['required', 'string', 'max:1000'],
            'items.*.amount' => ['required', 'integer', 'min:1'],
            'total_amount' => ['required', 'integer', 'min:1'],
            'receipt_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            $data = [
                'expense_date' => $validated['expense_date'],
                'items' => $validated['items'],
                'total_amount' => $validated['total_amount'],
                'notes' => $validated['notes'] ?? null,
                'created_by' => Auth::id(),
            ];

            if ($request->hasFile('receipt_image')) {
                $data['receipt_image'] = $request->file('receipt_image')->store('expenses', 'public');
            }

            Expense::create($data);

            return redirect()->route('finance.expenses.index')->with('success', 'Pengeluaran berhasil ditambahkan');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function show(Expense $expense)
    {
        $expense->load('creator');
        return view('finance.expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $categories = ['Bahan Makanan', 'Alat Dapur', 'Gaji Karyawan', 'Utilitas (Listrik, Air, Gas)', 'Transportasi', 'Sewa Tempat', 'Lainnya'];

        return view('finance.expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'expense_date' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.category' => ['required', 'string', 'max:255'],
            'items.*.description' => ['required', 'string', 'max:1000'],
            'items.*.amount' => ['required', 'integer', 'min:1'],
            'total_amount' => ['required', 'integer', 'min:1'],
            'receipt_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            $data = [
                'expense_date' => $validated['expense_date'],
                'items' => $validated['items'],
                'total_amount' => $validated['total_amount'],
                'notes' => $validated['notes'] ?? null,
            ];

            if ($request->hasFile('receipt_image')) {
                // Delete old image
                if ($expense->receipt_image) {
                    Storage::disk('public')->delete($expense->receipt_image);
                }
                $data['receipt_image'] = $request->file('receipt_image')->store('expenses', 'public');
            }

            $expense->update($data);

            return redirect()->route('finance.expenses.index')->with('success', 'Pengeluaran berhasil diperbarui');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy(Expense $expense)
    {
        try {
            // Delete image if exists
            if ($expense->receipt_image) {
                Storage::disk('public')->delete($expense->receipt_image);
            }

            $expense->delete();

            return redirect()->route('finance.expenses.index')->with('success', 'Pengeluaran berhasil dihapus');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Gagal menghapus pengeluaran.');
        }
    }
}
