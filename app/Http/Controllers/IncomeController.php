<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $incomes = Income::with('creator')
            ->whereBetween('income_date', [$startDate, $endDate])
            ->latest('income_date')
            ->paginate(15);

        $totalIncomes = Income::whereBetween('income_date', [$startDate, $endDate])->sum('total_amount');

        return view('finance.incomes.index', compact('incomes', 'totalIncomes', 'startDate', 'endDate'));
    }

    public function create()
    {
        return view('finance.incomes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'income_date' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.source' => ['required', 'string', 'max:255'],
            'items.*.description' => ['required', 'string', 'max:1000'],
            'items.*.amount' => ['required', 'integer', 'min:1'],
            'total_amount' => ['required', 'integer', 'min:1'],
            'proof_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            $data = [
                'income_date' => $validated['income_date'],
                'items' => $validated['items'],
                'total_amount' => $validated['total_amount'],
                'notes' => $validated['notes'] ?? null,
                'created_by' => Auth::id(),
            ];

            if ($request->hasFile('proof_image')) {
                $data['proof_image'] = $request->file('proof_image')->store('incomes', 'public');
            }

            Income::create($data);

            return redirect()->route('finance.incomes.index')->with('success', 'Pemasukan berhasil ditambahkan');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function show(Income $income)
    {
        $income->load('creator');
        return view('finance.incomes.show', compact('income'));
    }

    public function edit(Income $income)
    {
        return view('finance.incomes.edit', compact('income'));
    }

    public function update(Request $request, Income $income)
    {
        $validated = $request->validate([
            'income_date' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.source' => ['required', 'string', 'max:255'],
            'items.*.description' => ['required', 'string', 'max:1000'],
            'items.*.amount' => ['required', 'integer', 'min:1'],
            'total_amount' => ['required', 'integer', 'min:1'],
            'proof_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            $data = [
                'income_date' => $validated['income_date'],
                'items' => $validated['items'],
                'total_amount' => $validated['total_amount'],
                'notes' => $validated['notes'] ?? null,
            ];

            if ($request->hasFile('proof_image')) {
                // Delete old image
                if ($income->proof_image) {
                    Storage::disk('public')->delete($income->proof_image);
                }
                $data['proof_image'] = $request->file('proof_image')->store('incomes', 'public');
            }

            $income->update($data);

            return redirect()->route('finance.incomes.index')->with('success', 'Pemasukan berhasil diperbarui');
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy(Income $income)
    {
        try {
            // Delete image if exists
            if ($income->proof_image) {
                Storage::disk('public')->delete($income->proof_image);
            }

            $income->delete();

            return redirect()->route('finance.incomes.index')->with('success', 'Pemasukan berhasil dihapus');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Gagal menghapus pemasukan.');
        }
    }
}
