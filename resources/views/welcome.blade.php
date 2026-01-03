<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-indigo-600">
                {{ config('app.name', 'MyApp') }}
            </div>

            <div class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                    Kelola Pesanan & Data Bisnis<br>
                    <span class="text-indigo-600">Lebih Cepat dan Terstruktur</span>
                </h1>

                <p class="text-gray-600 text-lg mb-8">
                    Aplikasi ini membantu Anda mengelola menu, pesanan,
                    pelanggan, dan kategori dalam satu dashboard admin yang rapi.
                </p>

                <div class="flex gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-3 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                            Masuk Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="px-6 py-3 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                            Mulai Sekarang
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-6 py-3 rounded-lg border border-gray-300 hover:bg-gray-100">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            <!-- HERO IMAGE / ILLUSTRATION -->
            <div class="hidden md:block">
                <div class="bg-indigo-100 rounded-2xl p-10 text-center">
                    <p class="text-indigo-600 font-semibold">
                        Dashboard Admin Preview
                    </p>
                    <div
                        class="mt-6 h-48 bg-white rounded-xl shadow-inner flex items-center justify-center text-gray-400">
                        (Preview Dashboard)
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">
                Fitur Utama
            </h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 border rounded-xl hover:shadow-md transition">
                    <h3 class="font-semibold text-lg mb-2">
                        Manajemen Pesanan
                    </h3>
                    <p class="text-gray-600">
                        Pantau status pesanan dari pending hingga selesai
                        langsung dari dashboard admin.
                    </p>
                </div>

                <div class="p-6 border rounded-xl hover:shadow-md transition">
                    <h3 class="font-semibold text-lg mb-2">
                        Data Menu & Kategori
                    </h3>
                    <p class="text-gray-600">
                        Kelola menu dan kategori dengan struktur data
                        yang rapi dan mudah dikembangkan.
                    </p>
                </div>

                <div class="p-6 border rounded-xl hover:shadow-md transition">
                    <h3 class="font-semibold text-lg mb-2">
                        Dashboard Informatif
                    </h3>
                    <p class="text-gray-600">
                        Ringkasan data penting seperti total pesanan,
                        pelanggan, dan pendapatan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">
                Siap Mengelola Bisnis Lebih Profesional?
            </h2>
            <p class="text-gray-600 mb-8">
                Mulai gunakan aplikasi ini dan nikmati dashboard admin
                yang bersih dan mudah dikembangkan.
            </p>

            @guest
                <a href="{{ route('register') }}"
                    class="inline-block px-8 py-3 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    Daftar Sekarang
                </a>
            @endguest
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-100 py-6">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-500">
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>

</body>

</html>
