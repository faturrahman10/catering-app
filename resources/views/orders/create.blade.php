@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            {{-- CUSTOMER --}}
            <div class="mb-3">
                <label>Customer</label>
                <select name="customer_id" class="form-control" required>
                    <option value="">-- Pilih Customer --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- TANGGAL --}}
            <div class="mb-3">
                <label>Tanggal Order</label>
                <input type="date" name="order_date" class="form-control" required>
            </div>

            <hr>

            {{-- ITEM MENU --}}
            <h4>Menu</h4>

            @foreach ($menus as $index => $menu)
                <div class="row mb-2">
                    <div class="col-md-6">
                        <input type="checkbox" name="items[{{ $index }}][menu_id]" value="{{ $menu->id }}">
                        {{ $menu->name }} (Rp {{ number_format($menu->price) }})
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="items[{{ $index }}][qty]" class="form-control" min="1"
                            placeholder="Qty">
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-success mt-3">
                Simpan Order
            </button>
        </form>
    </div>
@endsection
