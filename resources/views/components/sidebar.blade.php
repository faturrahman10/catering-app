<div class="w-64 bg-white border-r min-h-screen p-4">
    <h2 class="text-lg font-bold mb-6">Admin Panel</h2>

    <nav class="space-y-2 text-sm">
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
            📊 Dashboard
        </a>

        <a href="{{ route('orders.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
            🧾 Order
        </a>

        <a href="{{ route('menus.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
            🍱 Menu
        </a>

        <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
            📂 Category
        </a>

        <a href="{{ route('customers.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">
            👤 Customer
        </a>
    </nav>
</div>
