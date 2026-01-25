<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <!-- Prevent dark mode flash -->
    <script>
        if (
            localStorage.getItem('darkMode') === 'true' ||
            (!localStorage.getItem('darkMode') &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-950" x-data="{
        sidebarOpen: false,
        darkMode: localStorage.getItem('darkMode') === 'true'
    }" x-init="$watch('darkMode', value => {
        localStorage.setItem('darkMode', value);
        document.documentElement.classList.toggle('dark', value);
    })"
        @keydown.escape.window="sidebarOpen = false">

        {{-- Sidebar --}}
        @include('components.sidebar')

        {{-- Main Content Area dengan margin-left --}}
        <div class="lg:ml-64 flex flex-col min-h-screen">

            {{-- Top Navigation --}}
            @include('layouts.navigation')

            {{-- Page Header --}}
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow-sm">
                    <div class="px-4 py-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Page Content --}}
            <main class="flex-1">
                {{ $slot }}
            </main>

        </div>
    </div>

    @stack('scripts')
</body>

</html>
