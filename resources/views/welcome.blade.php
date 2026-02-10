<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeSwitcher()" :class="{ 'dark': dark }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'CateringApp') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark .glass-effect {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 text-gray-800 dark:text-gray-100 transition-all duration-300">

    <!-- NAVBAR -->
    <nav x-data="{
        mobileMenu: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 20
            })
        }
    }" :class="scrolled ? 'shadow-lg' : ''"
        class="fixed top-0 left-0 right-0 z-50 glass-effect transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo - SVG Version -->
                <a href="/" class="flex items-center space-x-3 group">
                    <div
                        class="relative w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500 flex items-center justify-center shadow-lg group-hover:shadow-indigo-500/50 transition-all duration-300">
                        <!-- Chef Hat SVG Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold gradient-text hidden sm:block">
                        {{ config('app.name', 'CateringApp') }}
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#menu" class="nav-link">Menu</a>
                    <a href="#cara-kerja" class="nav-link">Cara Pesan</a>
                    <a href="#testimoni" class="nav-link">Testimoni</a>
                    <a href="#paket" class="nav-link">Paket</a>

                    <!-- Theme Toggle -->
                    <button @click="toggle()"
                        class="p-2.5 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-all duration-200 group">
                        <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-600 group-hover:text-indigo-600 transition-colors" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="dark" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-300 group-hover:text-yellow-400 transition-colors" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>

                    <a href="{{ route('login') }}" class="cta-button">
                        <span>Pesan Sekarang</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu"
                    class="md:hidden p-2 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-all">
                    <svg x-show="!mobileMenu" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenu" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu - Improved -->
        <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" @click.away="mobileMenu = false"
            class="md:hidden glass-effect border-t dark:border-gray-700">
            <div class="px-4 py-4 space-y-1">
                <a href="#menu" @click="mobileMenu = false"
                    class="block py-3 px-4 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-colors">Menu</a>
                <a href="#cara-kerja" @click="mobileMenu = false"
                    class="block py-3 px-4 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-colors">Cara
                    Pesan</a>
                <a href="#testimoni" @click="mobileMenu = false"
                    class="block py-3 px-4 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-colors">Testimoni</a>
                <a href="#paket" @click="mobileMenu = false"
                    class="block py-3 px-4 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-colors">Paket</a>

                <div class="pt-4 border-t dark:border-gray-700">
                    <a href="{{ route('login') }}"
                        class="block w-full text-center px-6 py-3 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow-lg">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION with Modern Design -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="animate-fade-in-up space-y-8">
                    <div
                        class="inline-block px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold">
                        ✨ Catering Premium #1 di Indonesia
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">
                        Nikmati Makanan
                        <span class="gradient-text block mt-2">Lezat & Bergizi</span>
                        Setiap Hari
                    </h1>

                    <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                        Pesan catering praktis dengan menu variatif, bahan segar, dan pengantaran tepat waktu. Solusi
                        makan harian untuk keluarga, kantor, dan acara spesial Anda.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}"
                            class="px-8 py-4 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300 text-center">
                            Mulai Pesan Gratis
                        </a>
                        <a href="#menu"
                            class="px-8 py-4 rounded-full border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400 font-semibold hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all text-center">
                            Lihat Menu
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t dark:border-gray-700">
                        <div>
                            <div class="text-3xl font-bold text-indigo-600">1000+</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Pelanggan Setia</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-indigo-600">50+</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Menu Pilihan</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-indigo-600">4.9</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Rating Google</div>
                        </div>
                    </div>
                </div>

                <!-- Right Image with Floating Effect -->
                <div class="relative animate-float">
                    <div class="relative z-9">
                        <div
                            class="rounded-3xl bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500 p-1 shadow-2xl">
                            <div class="rounded-3xl bg-white dark:bg-gray-900 p-8">
                                <div
                                    class="aspect-square rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-950/50 dark:to-purple-950/50 flex items-center justify-center overflow-hidden relative group">
                                    <!-- Background Pattern -->
                                    <div class="absolute inset-0 opacity-5">
                                        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <pattern id="dots" x="0" y="0" width="20" height="20"
                                                    patternUnits="userSpaceOnUse">
                                                    <circle cx="2" cy="2" r="1"
                                                        fill="currentColor" />
                                                </pattern>
                                            </defs>
                                            <rect width="100%" height="100%" fill="url(#dots)" />
                                        </svg>
                                    </div>

                                    <div class="text-center space-y-6 relative z-10">
                                        <!-- Premium Catering Icon -->
                                        <div class="relative inline-block">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-full blur-xl opacity-50 group-hover:opacity-75 transition-opacity">
                                            </div>
                                            <svg class="w-24 h-24 text-indigo-600 dark:text-indigo-400 relative transform group-hover:scale-110 transition-transform duration-300"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                                <!-- Food elements -->
                                                <circle cx="9" cy="9" r="1.5" fill="currentColor" />
                                                <circle cx="15" cy="9" r="1.5" fill="currentColor" />
                                                <circle cx="12" cy="12" r="1.5" fill="currentColor" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xl font-bold text-gray-900 dark:text-white mb-1">Premium
                                                Catering</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Layanan Berkualitas
                                                Tinggi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Card - Rating -->
                    <div
                        class="absolute -top-6 -right-6 w-36 h-36 rounded-2xl glass-effect p-5 shadow-2xl hover:shadow-indigo-500/20 hover:-translate-y-1 transition-all duration-300 border border-white/20">
                        <div class="flex flex-col items-center justify-center h-full space-y-2">
                            <!-- Star Icon -->
                            <div class="relative">
                                <div class="absolute inset-0 bg-yellow-400 rounded-full blur-md opacity-50"></div>
                                <svg class="w-12 h-12 text-yellow-400 relative" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">4.9/5</div>
                                <div class="text-xs font-semibold text-gray-600 dark:text-gray-400">Rating Pelanggan
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Card - Free Delivery -->
                    <div
                        class="absolute -bottom-6 -left-6 w-36 h-36 rounded-2xl glass-effect p-5 shadow-2xl hover:shadow-purple-500/20 hover:-translate-y-1 transition-all duration-300 border border-white/20">
                        <div class="flex flex-col items-center justify-center h-full space-y-2">
                            <!-- Delivery Truck Icon -->
                            <div class="relative">
                                <div class="absolute inset-0 bg-green-400 rounded-full blur-md opacity-50"></div>
                                <svg class="w-12 h-12 text-green-500 relative" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <div class="text-sm font-bold text-gray-900 dark:text-white">Gratis Ongkir</div>
                                <div class="text-xs font-semibold text-gray-600 dark:text-gray-400">Area Tertentu</div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Floating Badge - New -->
                    <div class="absolute top-1/2 -right-4 transform -translate-y-1/2">
                        <div
                            class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-500 to-rose-600 shadow-lg flex items-center justify-center animate-pulse">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white/50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4">
                    Kenapa <span class="gradient-text">Pilih Kami?</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Kami berkomitmen memberikan pengalaman catering terbaik dengan kualitas premium
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="group p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        🍽️
                    </div>
                    <h3 class="text-xl font-bold mb-3">Menu Variatif</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        50+ pilihan menu yang berganti setiap minggu untuk kepuasan maksimal
                    </p>
                </div>

                <div
                    class="group p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        🥗
                    </div>
                    <h3 class="text-xl font-bold mb-3">Bahan Premium</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Bahan segar pilihan setiap hari dengan standar kualitas tertinggi
                    </p>
                </div>

                <div
                    class="group p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        🚚
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pengiriman Cepat</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Gratis ongkir untuk area tertentu dan tepat waktu setiap hari
                    </p>
                </div>

                <div
                    class="group p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        💰
                    </div>
                    <h3 class="text-xl font-bold mb-3">Harga Terjangkau</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Paket hemat mulai dari 25rb/porsi dengan kualitas premium
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="cara-kerja" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4">
                    Cara <span class="gradient-text">Pemesanan</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Hanya 4 langkah mudah untuk menikmati catering premium kami
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="relative mb-6">
                        <div
                            class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-4xl group-hover:scale-110 transition-transform">
                            🍽️
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">
                            1
                        </div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Pilih Menu</h3>
                    <p class="text-gray-600 dark:text-gray-400">Jelajahi 50+ menu lezat kami</p>
                </div>

                <div class="text-center group">
                    <div class="relative mb-6">
                        <div
                            class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-4xl group-hover:scale-110 transition-transform">
                            🗓️
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center font-bold text-sm">
                            2
                        </div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Tentukan Jadwal</h3>
                    <p class="text-gray-600 dark:text-gray-400">Pilih tanggal dan waktu delivery</p>
                </div>

                <div class="text-center group">
                    <div class="relative mb-6">
                        <div
                            class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-4xl group-hover:scale-110 transition-transform">
                            💳
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-orange-600 text-white flex items-center justify-center font-bold text-sm">
                            3
                        </div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Bayar Mudah</h3>
                    <p class="text-gray-600 dark:text-gray-400">Transfer, e-wallet, atau COD</p>
                </div>

                <div class="text-center group">
                    <div class="relative mb-6">
                        <div
                            class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center text-4xl group-hover:scale-110 transition-transform">
                            🎉
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-pink-600 text-white flex items-center justify-center font-bold text-sm">
                            4
                        </div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Terima & Nikmati</h3>
                    <p class="text-gray-600 dark:text-gray-400">Makanan sampai tepat waktu!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING PACKAGES -->
    <section id="paket" class="py-20 px-4 sm:px-6 lg:px-8 bg-white/50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4">
                    Paket <span class="gradient-text">Terbaik Kami</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Pilih paket yang sesuai dengan kebutuhan Anda
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Basic Package -->
                <div
                    class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 hover:shadow-2xl transition-all">
                    <div class="text-center mb-6">
                        <div class="text-4xl mb-4">🥗</div>
                        <h3 class="text-2xl font-bold mb-2">Paket Hemat</h3>
                        <div class="text-4xl font-bold gradient-text mb-2">25K</div>
                        <p class="text-gray-600 dark:text-gray-400">per porsi</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2">✓</span>
                            <span class="text-gray-600 dark:text-gray-400">1 Nasi + 1 Lauk</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2">✓</span>
                            <span class="text-gray-600 dark:text-gray-400">1 Sayur</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2">✓</span>
                            <span class="text-gray-600 dark:text-gray-400">Free Delivery</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}"
                        class="block w-full py-3 rounded-full border-2 border-indigo-600 text-indigo-600 font-semibold text-center hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all">
                        Pilih Paket
                    </a>
                </div>

                <!-- Popular Package -->
                <div
                    class="rounded-3xl bg-gradient-to-br from-indigo-600 to-purple-600 p-8 text-white transform scale-105 hover:shadow-2xl transition-all relative">
                    <div
                        class="absolute -top-4 left-1/2 -translate-x-1/2 px-6 py-2 rounded-full bg-yellow-400 text-gray-900 font-bold text-sm">
                        PALING POPULER
                    </div>
                    <div class="text-center mb-6">
                        <div class="text-4xl mb-4">🍱</div>
                        <h3 class="text-2xl font-bold mb-2">Paket Komplit</h3>
                        <div class="text-4xl font-bold mb-2">40K</div>
                        <p class="text-indigo-100">per porsi</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <span class="text-yellow-300 mr-2">✓</span>
                            <span>1 Nasi + 2 Lauk</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-yellow-300 mr-2">✓</span>
                            <span>1 Sayur + Buah</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-yellow-300 mr-2">✓</span>
                            <span>Free Delivery</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-yellow-300 mr-2">✓</span>
                            <span>1 Minuman</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}"
                        class="block w-full py-3 rounded-full bg-white text-indigo-600 font-semibold text-center hover:bg-gray-100 transition-all">
                        Pilih Paket
                    </a>
                </div>

                <!-- Premium Package -->
                <div
                    class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-8 hover:shadow-2xl transition-all">
                    <div class="text-center mb-6">
                        <div class="text-4xl mb-4">👑</div>
                        <h3 class="text-2xl font-bold mb-2">Paket Premium</h3>
                        <div class="text-4xl font-bold gradient-text mb-2">60K</div>
                        <p class="text-gray-600 dark:text-gray-400">per porsi</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2">✓</span>
                            <span class="text-gray-600 dark:text-gray-400">1 Nasi + 3 Lauk Premium</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2">✓</span>
                            <span class="text-gray-600 dark:text-gray-400">2 Sayur + Buah</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2">✓</span>
                            <span class="text-gray-600 dark:text-gray-400">Free Delivery</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-2">✓</span>
                            <span class="text-gray-600 dark:text-gray-400">2 Minuman + Dessert</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}"
                        class="block w-full py-3 rounded-full border-2 border-indigo-600 text-indigo-600 font-semibold text-center hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all">
                        Pilih Paket
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section id="testimoni" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4">
                    Kata <span class="gradient-text">Pelanggan Kami</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Ribuan pelanggan puas dengan layanan kami
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold mr-4">
                            A
                        </div>
                        <div>
                            <div class="font-bold">Ani Setiawati</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Ibu Rumah Tangga</div>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-600 dark:text-gray-400">
                        "Menu variatif dan rasanya enak banget! Anak-anak saya suka semua. Pengantaran juga selalu tepat
                        waktu. Recommended!"
                    </p>
                </div>

                <div
                    class="p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white font-bold mr-4">
                            B
                        </div>
                        <div>
                            <div class="font-bold">Budi Santoso</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Karyawan Swasta</div>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-600 dark:text-gray-400">
                        "Sangat membantu untuk makan siang di kantor. Harganya terjangkau tapi kualitasnya premium.
                        Pelayanan juga ramah!"
                    </p>
                </div>

                <div
                    class="p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center text-white font-bold mr-4">
                            C
                        </div>
                        <div>
                            <div class="font-bold">Citra Dewi</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Pengusaha</div>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-600 dark:text-gray-400">
                        "Sudah langganan 6 bulan. Menu selalu fresh dan higienis. Sistemnya juga mudah, tinggal order
                        lewat app!"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- MENU PREVIEW -->
    <section id="menu" class="py-20 px-4 sm:px-6 lg:px-8 bg-white/50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4">
                    Menu <span class="gradient-text">Favorit Minggu Ini</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Pilihan menu terpopuler dari pelanggan kami
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="group rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="aspect-square bg-gradient-to-br from-orange-100 to-red-100 dark:from-orange-900/40 dark:to-red-900/40 flex items-center justify-center text-6xl">
                        🍗
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Ayam Geprek</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Ayam crispy dengan sambal level</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600">35K</span>
                            <span class="text-yellow-400">⭐ 4.8</span>
                        </div>
                    </div>
                </div>

                <div
                    class="group rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="aspect-square bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/40 dark:to-emerald-900/40 flex items-center justify-center text-6xl">
                        🍜
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Soto Ayam</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Soto ayam kuah gurih nikmat</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600">30K</span>
                            <span class="text-yellow-400">⭐ 4.9</span>
                        </div>
                    </div>
                </div>

                <div
                    class="group rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="aspect-square bg-gradient-to-br from-red-100 to-pink-100 dark:from-red-900/40 dark:to-pink-900/40 flex items-center justify-center text-6xl">
                        🥘
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Rendang Sapi</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Rendang empuk bumbu meresap</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600">45K</span>
                            <span class="text-yellow-400">⭐ 5.0</span>
                        </div>
                    </div>
                </div>

                <div
                    class="group rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="aspect-square bg-gradient-to-br from-yellow-100 to-orange-100 dark:from-yellow-900/40 dark:to-orange-900/40 flex items-center justify-center text-6xl">
                        🍛
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Nasi Goreng</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Nasi goreng spesial komplit</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600">28K</span>
                            <span class="text-yellow-400">⭐ 4.7</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('register') }}"
                    class="inline-block px-8 py-4 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    Lihat Semua Menu
                </a>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-20 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-4xl mx-auto text-center relative z-10">
            <div class="inline-block px-4 py-2 rounded-full bg-white/20 text-white text-sm font-semibold mb-6">
                🎉 Promo Spesial Pelanggan Baru
            </div>

            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6">
                Siap Nikmati Makanan Enak<br>Tanpa Ribet?
            </h2>

            <p class="text-lg text-white/90 mb-10 max-w-2xl mx-auto">
                Daftar sekarang dan dapatkan diskon 20% untuk pemesanan pertama Anda! Tidak ada biaya tersembunyi,
                gratis ongkir area tertentu.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}"
                    class="px-10 py-4 rounded-full bg-white text-indigo-600 font-bold hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-2xl">
                    Daftar & Dapat Diskon 20%
                </a>
                <a href="#menu"
                    class="px-10 py-4 rounded-full border-2 border-white text-white font-bold hover:bg-white/10 transition-all">
                    Lihat Menu Dulu
                </a>
            </div>

            <div class="mt-12 flex flex-wrap justify-center gap-8 text-white">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Gratis Ongkir</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Bisa Cancel Anytime</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Garansi Uang Kembali</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white/50 dark:bg-gray-800/50">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4">
                    Pertanyaan <span class="gradient-text">yang Sering Diajukan</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Temukan jawaban untuk pertanyaan Anda
                </p>
            </div>

            <div class="space-y-4" x-data="{ active: null }">
                <div
                    class="rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <button @click="active = active === 1 ? null : 1"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                        <span class="font-semibold text-left">Bagaimana cara memesan catering?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': active === 1 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-6 pb-5 text-gray-600 dark:text-gray-400">
                        Sangat mudah! Cukup daftar akun, pilih menu favorit Anda, tentukan jadwal pengiriman, lalu
                        lakukan pembayaran. Tim kami akan mengantarkan pesanan tepat waktu.
                    </div>
                </div>

                <div
                    class="rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <button @click="active = active === 2 ? null : 2"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                        <span class="font-semibold text-left">Apakah ada minimum order?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': active === 2 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-6 pb-5 text-gray-600 dark:text-gray-400">
                        Untuk pemesanan harian, minimum order 1 porsi. Untuk paket bulanan atau acara khusus, silakan
                        hubungi CS kami untuk penawaran terbaik.
                    </div>
                </div>

                <div
                    class="rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <button @click="active = active === 3 ? null : 3"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                        <span class="font-semibold text-left">Area mana saja yang dilayani?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': active === 3 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-6 pb-5 text-gray-600 dark:text-gray-400">
                        Kami melayani seluruh wilayah Jakarta, Bogor, Depok, Tangerang, dan Bekasi. Untuk area lain,
                        silakan hubungi CS kami.
                    </div>
                </div>

                <div
                    class="rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <button @click="active = active === 4 ? null : 4"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                        <span class="font-semibold text-left">Bagaimana jika saya ingin cancel pesanan?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': active === 4 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 4" x-collapse class="px-6 pb-5 text-gray-600 dark:text-gray-400">
                        Pembatalan dapat dilakukan maksimal H-1 sebelum jadwal pengiriman. Pembatalan pada hari yang
                        sama tidak dapat dilakukan.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white font-bold text-xl">🍽️</span>
                        </div>
                        <span class="text-xl font-bold text-white">
                            {{ config('app.name', 'CateringApp') }}
                        </span>
                    </div>
                    <p class="text-sm mb-6">
                        Solusi catering praktis dengan menu variatif dan kualitas terjamin untuk kebutuhan harian Anda.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-800 hover:bg-indigo-600 flex items-center justify-center transition-all">
                            <span>📘</span>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-800 hover:bg-pink-600 flex items-center justify-center transition-all">
                            <span>📷</span>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-800 hover:bg-green-600 flex items-center justify-center transition-all">
                            <span>💬</span>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-bold mb-6">Menu</h3>
                    <ul class="space-y-3">
                        <li><a href="#menu" class="hover:text-indigo-400 transition-colors">Menu Harian</a></li>
                        <li><a href="#paket" class="hover:text-indigo-400 transition-colors">Paket Catering</a></li>
                        <li><a href="#cara-kerja" class="hover:text-indigo-400 transition-colors">Cara Pesan</a></li>
                        <li><a href="#testimoni" class="hover:text-indigo-400 transition-colors">Testimoni</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-white font-bold mb-6">Bantuan</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Syarat & Ketentuan</a>
                        </li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Kebijakan Privasi</a>
                        </li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-white font-bold mb-6">Kontak</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <span class="mr-3">📍</span>
                            <span class="text-sm">Jl. Contoh No. 123, Jakarta Selatan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-3">📧</span>
                            <span class="text-sm">info@cateringapp.com</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-3">📱</span>
                            <span class="text-sm">+62 812-3456-7890</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="pt-8 border-t border-gray-800 text-center text-sm">
                <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved. Made with ❤️ in Indonesia</p>
            </div>
        </div>
    </footer>

    <!-- Dark Mode Script -->
    <script>
        function themeSwitcher() {
            return {
                dark: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches),
                toggle() {
                    this.dark = !this.dark
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light')
                }
            }
        }
    </script>

</body>

</html>
