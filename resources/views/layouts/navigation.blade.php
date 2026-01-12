<nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-30">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Left --}}
            <div class="flex items-center gap-3">

                {{-- Mobile: Sidebar Toggle --}}
                <button @click="sidebarOpen = true"
                    class="lg:hidden p-2 rounded-lg text-gray-500 dark:text-gray-400
                           hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                {{-- Page Title (desktop) --}}
                <h1 class="hidden lg:block text-lg font-semibold text-gray-800 dark:text-gray-200">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>

            {{-- Right --}}
            <div class="flex items-center gap-3">

                {{-- Dark Mode --}}
                <button @click="darkMode = !darkMode"
                    class="p-2 rounded-lg text-gray-500 dark:text-gray-400
                           hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646
                                 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646" />
                    </svg>

                    <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3
                                 m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707
                                 m12.728 0l-.707.707M6.343 17.657l-.707.707
                                 M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                {{-- User Dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-2 px-3 py-2 border rounded-lg
                                       text-sm font-medium text-gray-700 dark:text-gray-300
                                       bg-white dark:bg-gray-800
                                       border-gray-200 dark:border-gray-700
                                       hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500
                                        flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>
        </div>
    </div>
</nav>
