{{-- Top Navigation Bar (Profile & Settings) --}}
<nav x-data="{ open: false }"
    class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-30">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Left Side: Page Title (visible on desktop) --}}
            <div class="hidden lg:flex items-center">
                <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>

            {{-- Mobile: Logo --}}
            <div class="flex items-center lg:hidden">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            {{-- Right Side: User Settings --}}
            <div class="flex items-center ms-auto gap-3">

                {{-- Dark Mode Toggle (Desktop) --}}
                <button @click="darkMode = !darkMode"
                    class="hidden sm:flex p-2 rounded-lg text-gray-500 dark:text-gray-400 
                               hover:bg-gray-100 dark:hover:bg-gray-800 
                               transition-colors duration-200"
                    :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'">
                    {{-- Moon Icon (Light Mode) --}}
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    {{-- Sun Icon (Dark Mode) --}}
                    <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                {{-- User Dropdown (Desktop) --}}
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center gap-2 px-3 py-2 border border-gray-200 dark:border-gray-700 
                                           rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 
                                           bg-white dark:bg-gray-800 
                                           hover:bg-gray-50 dark:hover:bg-gray-700 
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900
                                           transition ease-in-out duration-150">
                                <div
                                    class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 
                                            flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left hidden md:block">
                                    <div class="font-semibold">{{ Auth::user()->name }}</div>
                                </div>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                                <div class="font-medium text-sm text-gray-900 dark:text-gray-100">
                                    {{ Auth::user()->name }}</div>
                                <div class="font-medium text-xs text-gray-500 dark:text-gray-400">
                                    {{ Auth::user()->email }}</div>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ __('Profile') }}
                                </div>
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <div class="flex items-center gap-2 text-red-600 dark:text-red-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('Log Out') }}
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                {{-- Mobile Menu Button --}}
                <div class="flex items-center sm:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-lg 
                                   text-gray-500 dark:text-gray-400 
                                   hover:bg-gray-100 dark:hover:bg-gray-800 
                                   focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 
                                   transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- Responsive Mobile Menu --}}
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden border-t border-gray-200 dark:border-gray-800">

        {{-- User Info --}}
        <div class="pt-4 pb-3 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center px-4 gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 
                            flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-semibold text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>

        {{-- Mobile Menu Options --}}
        <div class="py-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('Profile') }}
                </div>
            </x-responsive-nav-link>

            {{-- Dark Mode Toggle (Mobile) --}}
            <button @click="darkMode = !darkMode"
                class="w-full flex items-center gap-3 px-4 py-2 text-left text-base font-medium 
                           text-gray-600 dark:text-gray-400 
                           hover:text-gray-800 dark:hover:text-gray-200 
                           hover:bg-gray-100 dark:hover:bg-gray-800 
                           focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 
                           focus:bg-gray-100 dark:focus:bg-gray-800
                           transition duration-150 ease-in-out">
                {{-- Moon Icon --}}
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                {{-- Sun Icon --}}
                <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span x-text="darkMode ? 'Light Mode' : 'Dark Mode'">Dark Mode</span>
            </button>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <div class="flex items-center gap-3 text-red-600 dark:text-red-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Log Out') }}
                    </div>
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
