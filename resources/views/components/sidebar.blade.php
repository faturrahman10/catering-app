{{-- Mobile Overlay --}}
<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
    class="fixed inset-0 z-40 bg-gray-900/80 lg:hidden" style="display: none;"></div>

{{-- Sidebar --}}
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64
           bg-white dark:bg-gray-900
           border-r border-gray-200 dark:border-gray-800
           transform transition-transform duration-300 ease-in-out
           lg:translate-x-0
           flex flex-col">

    {{-- Header --}}
    <div class="h-16 flex items-center justify-between px-6 border-b border-gray-200 dark:border-gray-800 flex-shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <x-application-logo class="h-8 w-auto text-indigo-600 dark:text-indigo-400" />
            <span class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Admin Panel
            </span>
        </a>

        {{-- Close (mobile) --}}
        <button @click="sidebarOpen = false"
            class="lg:hidden p-2 rounded-lg text-gray-500 dark:text-gray-400
                   hover:bg-gray-100 dark:hover:bg-gray-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        @php
            $base = 'group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200';
            $active = 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/40';
            $inactive = 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800';
            $icon = 'w-5 h-5 flex-shrink-0';
        @endphp

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" @click="sidebarOpen = false"
            class="{{ $base }} {{ request()->routeIs('dashboard') ? $active : $inactive }}">
            <svg class="{{ $icon }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        {{-- Orders --}}
        <a href="{{ route('orders.index') }}" @click="sidebarOpen = false"
            class="{{ $base }} {{ request()->routeIs('orders.*') ? $active : $inactive }}">
            <svg class="{{ $icon }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h18v4H3V3zm0 6h18v12H3V9zm4 4h6" />
            </svg>
            <span class="font-medium">Orders</span>
        </a>

        {{-- Menu --}}
        <a href="{{ route('menus.index') }}" @click="sidebarOpen = false"
            class="{{ $base }} {{ request()->routeIs('menus.*') ? $active : $inactive }}">
            <svg class="{{ $icon }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="font-medium">Menu</span>
        </a>

        {{-- Categories --}}
        <a href="{{ route('categories.index') }}" @click="sidebarOpen = false"
            class="{{ $base }} {{ request()->routeIs('categories.*') ? $active : $inactive }}">
            <svg class="{{ $icon }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h6M7 17h4" />
            </svg>
            <span class="font-medium">Categories</span>
        </a>
    </nav>

    {{-- Footer --}}
    <div class="p-4 border-t border-gray-200 dark:border-gray-800 flex-shrink-0">
        <div class="flex items-center gap-3 px-3 py-2 bg-gray-50 dark:bg-gray-800 rounded-lg">
            <div
                class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500
                       flex items-center justify-center text-white font-semibold text-xs">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Admin</p>
            </div>
        </div>
    </div>
</aside>
