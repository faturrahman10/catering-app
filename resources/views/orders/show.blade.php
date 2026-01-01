@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Order #{{ $order->id }}</h1>

        <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
        <p><strong>Tanggal:</strong> {{ $order->order_date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp {{ number_format($item->price) }}</td>
                        <td>Rp {{ number_format($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: Rp {{ number_format($order->total_price) }}</h4>

        <hr>

        {{-- UPDATE STATUS --}}
        <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
            @csrf
            @method('PATCH')

            <select name="status" class="form-control w-25 d-inline">
                @foreach (['pending', 'confirmed', 'cooking', 'ready', 'delivered', 'canceled'] as $status)
                    <option value="{{ $status }}" @selected($order->status == $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>

            <button class="btn btn-primary">
                Update Status
            </button>
        </form>
    </div>
@endsection
