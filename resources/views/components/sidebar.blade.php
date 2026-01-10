{{-- Sidebar Component with Dark Mode & Responsive --}}
<div x-data="{
    sidebarOpen: false,
    darkMode: localStorage.getItem('darkMode') === 'true' || false
}" x-init="$watch('darkMode', value => {
    localStorage.setItem('darkMode', value);
    if (value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
});
if (darkMode) {
    document.documentElement.classList.add('dark');
}">
    {{-- Mobile Overlay --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-gray-900/80 lg:hidden" style="display: none;">
    </div>

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-900 
                  border-r border-gray-200 dark:border-gray-800
                  transform transition-transform duration-300 ease-in-out
                  lg:translate-x-0 lg:static lg:inset-auto">

        {{-- Header --}}
        <div class="h-16 flex items-center justify-between px-6 border-b border-gray-200 dark:border-gray-800">
            <h2 class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Admin Panel
            </h2>

            {{-- Close button (mobile only) --}}
            <button @click="sidebarOpen = false"
                class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 
                           text-gray-500 dark:text-gray-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-lg
                      transition-all duration-200 ease-in-out
                      {{ request()->routeIs('dashboard')
                          ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/50'
                          : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? '' : 'group-hover:scale-110 transition-transform' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zm0-18v10h8V3h-8zM3 21h8v-6H3v6z" />
                </svg>
                <span class="font-medium">Dashboard</span>
                @if (request()->routeIs('dashboard'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            {{-- Orders --}}
            <a href="{{ route('orders.index') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-lg
                      transition-all duration-200 ease-in-out
                      {{ request()->routeIs('orders.*')
                          ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/50'
                          : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('orders.*') ? '' : 'group-hover:scale-110 transition-transform' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="font-medium">Orders</span>
                @if (request()->routeIs('orders.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            {{-- Menu --}}
            <a href="{{ route('menus.index') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-lg
                      transition-all duration-200 ease-in-out
                      {{ request()->routeIs('menus.*')
                          ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/50'
                          : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('menus.*') ? '' : 'group-hover:scale-110 transition-transform' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="font-medium">Menu</span>
                @if (request()->routeIs('menus.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            {{-- Categories --}}
            <a href="{{ route('categories.index') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-lg
                      transition-all duration-200 ease-in-out
                      {{ request()->routeIs('categories.*')
                          ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/50'
                          : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('categories.*') ? '' : 'group-hover:scale-110 transition-transform' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="font-medium">Categories</span>
                @if (request()->routeIs('categories.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

        </nav>

        {{-- Footer: Dark Mode Toggle --}}
        <div class="p-4 border-t border-gray-200 dark:border-gray-800">
            <button @click="darkMode = !darkMode"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg
                           text-gray-700 dark:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-800
                           transition-colors duration-200">
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg x-show="darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="font-medium" x-text="darkMode ? 'Light Mode' : 'Dark Mode'">Dark Mode</span>
            </button>
        </div>
    </aside>

    {{-- Mobile Menu Button --}}
    <button @click="sidebarOpen = true"
        class="fixed bottom-4 right-4 z-50 lg:hidden p-4 rounded-full 
                   bg-gradient-to-r from-indigo-500 to-purple-500 
                   text-white shadow-lg shadow-indigo-500/50
                   hover:shadow-xl hover:scale-110 transition-all duration-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>
