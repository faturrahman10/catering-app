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
        /* KEYFRAME ANIMATIONS */
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

        /* ANIMATION CLASSES */
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* GRADIENT TEXT */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* SMOOTH SCROLL */
        html {
            scroll-behavior: smooth;
        }

        /* NAVBAR STYLING */
        .navbar {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .navbar.scrolled {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        /* Light mode navbar */
        .light-mode .navbar {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-bottom: 1px solid #e2e8f0;
        }

        /* NAV LINK */
        .nav-link {
            position: relative;
            color: #cbd5e1;
            font-weight: 500;
            transition: all 0.2s;
            padding-bottom: 0.25rem;
        }

        .nav-link:hover {
            color: #818cf8;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #6366f1, #a855f7);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Light mode nav link */
        .light-mode .nav-link {
            color: #475569;
        }

        .light-mode .nav-link:hover {
            color: #6366f1;
        }

        /* CTA BUTTON */
        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.5rem;
            border-radius: 9999px;
            background: linear-gradient(to right, #6366f1, #a855f7);
            color: white;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
            transition: all 0.3s;
        }

        .cta-btn:hover {
            box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.6);
            transform: scale(1.05);
        }

        .cta-btn svg {
            transition: transform 0.3s;
        }

        .cta-btn:hover svg {
            transform: translateX(4px);
        }

        /* THEME TOGGLE BUTTON */
        .theme-toggle {
            padding: 0.625rem;
            border-radius: 0.5rem;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .light-mode .theme-toggle:hover {
            background: rgba(99, 102, 241, 0.1);
        }

        .theme-toggle svg {
            width: 1.25rem;
            height: 1.25rem;
            color: #cbd5e1;
            transition: all 0.2s;
        }

        .light-mode .theme-toggle svg {
            color: #64748b;
        }

        .theme-toggle:hover svg {
            color: #fbbf24;
        }

        .light-mode .theme-toggle:hover svg {
            color: #6366f1;
        }

        /* MOBILE MENU */
        .mobile-menu {
            display: none;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .light-mode .mobile-menu {
            background: white;
            border-top: 1px solid #e2e8f0;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-nav-link {
            display: block;
            padding: 0.75rem 1rem;
            color: #cbd5e1;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .mobile-nav-link:hover {
            background: rgba(99, 102, 241, 0.1);
            color: #818cf8;
        }

        .light-mode .mobile-nav-link {
            color: #475569;
        }

        .light-mode .mobile-nav-link:hover {
            background: rgba(99, 102, 241, 0.05);
            color: #6366f1;
        }

        /* MOBILE CTA */
        .mobile-cta {
            display: block;
            width: 100%;
            text-align: center;
            padding: 1rem 1.5rem;
            margin-top: 1rem;
            border-radius: 9999px;
            background: linear-gradient(to right, #6366f1, #a855f7, #ec4899);
            color: white;
            font-weight: 600;
            box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.5);
            transition: all 0.3s;
        }

        .mobile-cta:hover {
            box-shadow: 0 25px 30px -5px rgba(99, 102, 241, 0.7);
            transform: scale(1.02);
        }

        /* HAMBURGER MENU */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 0.25rem;
            padding: 0.5rem;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .hamburger span {
            width: 1.5rem;
            height: 2px;
            background: #cbd5e1;
            transition: all 0.3s;
        }

        .light-mode .hamburger span {
            background: #475569;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }
        }

        /* Progress Line Animation */
        @keyframes progress {
            0% {
                transform: scaleX(0);
            }

            100% {
                transform: scaleX(1);
            }
        }

        .animate-progress {
            animation: progress 3s ease-in-out forwards;
            animation-delay: 0.5s;
        }

        /* Pulse Animation for Step Icons */
        @keyframes ping {

            75%,
            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }

        .animate-ping {
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 text-gray-800 dark:text-gray-100 transition-all duration-300">

    <!-- NAVBAR -->
    <nav class="navbar fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3 group">
                    <div
                        class="relative w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500 flex items-center justify-center shadow-lg group-hover:shadow-indigo-500/50 transition-all duration-300">
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
                    <button onclick="toggleTheme()" class="theme-toggle">
                        <svg id="theme-icon-sun" class="hidden" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg id="theme-icon-moon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <a href="{{ route('login') }}" class="cta-btn">
                        <span>Pesan Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="hamburger md:hidden" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <div class="px-4 py-4 space-y-1">
                <a href="#menu" onclick="closeMobileMenu()" class="mobile-nav-link">Menu</a>
                <a href="#cara-kerja" onclick="closeMobileMenu()" class="mobile-nav-link">Cara Pesan</a>
                <a href="#testimoni" onclick="closeMobileMenu()" class="mobile-nav-link">Testimoni</a>
                <a href="#paket" onclick="closeMobileMenu()" class="mobile-nav-link">Paket</a>

                <a href="{{ route('login') }}" class="mobile-cta">
                    <span class="inline-flex items-center gap-2">
                        Pesan Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION with Modern Design -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="animate-fade-in-up space-y-8">
                    <!-- Badge - SVG Version -->
                    <div
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/30 dark:to-purple-900/30 border border-indigo-200 dark:border-indigo-800 text-indigo-600 dark:text-indigo-400 text-sm font-semibold shadow-sm">
                        <!-- Trophy/Award Icon -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span>Catering Premium #1 di Indonesia</span>
                    </div>

                    <!-- Heading - Improved Hierarchy -->
                    <div class="space-y-4">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight tracking-tight">
                            Nikmati Makanan
                            <span class="gradient-text block mt-2">Lezat & Bergizi</span>
                            Setiap Hari
                        </h1>
                        <div class="w-20 h-1.5 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full"></div>
                    </div>

                    <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-400 leading-relaxed max-w-2xl">
                        Pesan catering praktis dengan menu variatif, bahan segar, dan pengantaran tepat waktu. Solusi
                        makan harian untuk keluarga, kantor, dan acara spesial Anda.
                    </p>

                    <!-- CTA Buttons - Improved Hierarchy -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}"
                            class="group relative px-8 py-4 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:shadow-2xl hover:shadow-indigo-500/50 hover:scale-105 transition-all duration-300 text-center overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                Mulai Pesan Gratis
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                            <!-- Shine effect -->
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                            </div>
                        </a>

                        <a href="#menu"
                            class="group px-8 py-4 rounded-full border-2 border-indigo-600 dark:border-indigo-500 text-indigo-600 dark:text-indigo-400 font-semibold hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500 transition-all duration-300 text-center">
                            <span class="flex items-center justify-center gap-2">
                                Lihat Menu
                                <svg class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!-- Stats - Improved Layout & Icons -->
                    <div class="grid grid-cols-3 gap-4 sm:gap-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <div class="text-center sm:text-left group cursor-pointer">
                            <div class="flex items-center gap-2 justify-center sm:justify-start mb-1">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <div
                                    class="text-2xl sm:text-3xl font-bold text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform">
                                    1000+</div>
                            </div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 font-medium">Pelanggan
                                Setia</div>
                        </div>

                        <div class="text-center sm:text-left group cursor-pointer">
                            <div class="flex items-center gap-2 justify-center sm:justify-start mb-1">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                                <div
                                    class="text-2xl sm:text-3xl font-bold text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform">
                                    50+</div>
                            </div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 font-medium">Menu Pilihan
                            </div>
                        </div>

                        <div class="text-center sm:text-left group cursor-pointer">
                            <div class="flex items-center gap-2 justify-center sm:justify-start mb-1">
                                <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <div
                                    class="text-2xl sm:text-3xl font-bold text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform">
                                    4.9</div>
                            </div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 font-medium">Rating Google
                            </div>
                        </div>
                    </div>

                    <!-- Trust Indicators - NEW -->
                    <div class="flex flex-wrap items-center gap-4 pt-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span class="font-medium">100% Halal</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="font-medium">Bahan Segar</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium">Tepat Waktu</span>
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
    <section
        class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16 space-y-4">
                <div
                    class="inline-block px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-4">
                    Keunggulan Kami
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                    Kenapa <span class="gradient-text">Pilih Kami?</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Kami berkomitmen memberikan pengalaman catering terbaik dengan kualitas premium dan layanan
                    profesional
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                <!-- Feature 1: Menu Variatif -->
                <div
                    class="group relative p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2 transition-all duration-300">
                    <!-- Gradient Background on Hover -->
                    <div
                        class="absolute inset-0 rounded-2xl bg-gradient-to-br from-indigo-500/5 to-purple-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="relative z-10">
                        <!-- Icon Container -->
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg shadow-indigo-500/30">
                            <!-- Utensils/Restaurant Icon -->
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12h18M3 6h18M3 18h18" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Menu Variatif</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            50+ pilihan menu yang berganti setiap minggu untuk kepuasan maksimal
                        </p>

                        <!-- Decorative Arrow -->
                        <div
                            class="mt-4 flex items-center text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-sm font-semibold mr-2">Lihat Menu</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature 2: Bahan Premium -->
                <div
                    class="group relative p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-500 hover:shadow-2xl hover:shadow-green-500/10 hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="absolute inset-0 rounded-2xl bg-gradient-to-br from-green-500/5 to-emerald-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="relative z-10">
                        <!-- Icon Container -->
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg shadow-green-500/30">
                            <!-- Leaf/Organic Icon -->
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Bahan Premium</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Bahan segar pilihan setiap hari dengan standar kualitas tertinggi
                        </p>

                        <div
                            class="mt-4 flex items-center text-green-600 dark:text-green-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-sm font-semibold mr-2">Pelajari Lebih</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature 3: Pengiriman Cepat -->
                <div
                    class="group relative p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-orange-500 dark:hover:border-orange-500 hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="absolute inset-0 rounded-2xl bg-gradient-to-br from-orange-500/5 to-red-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="relative z-10">
                        <!-- Icon Container -->
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg shadow-orange-500/30">
                            <!-- Truck/Delivery Icon -->
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Pengiriman Cepat</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Gratis ongkir untuk area tertentu dan tepat waktu setiap hari
                        </p>

                        <div
                            class="mt-4 flex items-center text-orange-600 dark:text-orange-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-sm font-semibold mr-2">Cek Area</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Feature 4: Harga Terjangkau -->
                <div
                    class="group relative p-8 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-pink-500 dark:hover:border-pink-500 hover:shadow-2xl hover:shadow-pink-500/10 hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="absolute inset-0 rounded-2xl bg-gradient-to-br from-pink-500/5 to-rose-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="relative z-10">
                        <!-- Icon Container -->
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg shadow-pink-500/30">
                            <!-- Price Tag/Money Icon -->
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Harga Terjangkau</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Paket hemat mulai dari 25rb/porsi dengan kualitas premium
                        </p>

                        <div
                            class="mt-4 flex items-center text-pink-600 dark:text-pink-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-sm font-semibold mr-2">Lihat Paket</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom CTA -->
            <div class="mt-16 text-center">
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Masih ragu? Lihat testimoni dari 1000+ pelanggan kami
                </p>
                <a href="#testimoni"
                    class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:shadow-2xl hover:shadow-indigo-500/50 hover:scale-105 transition-all duration-300">
                    <span>Lihat Testimoni</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="cara-kerja" class="py-20 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16 space-y-4">
                <div
                    class="inline-block px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-4">
                    Mudah & Cepat
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                    Cara <span class="gradient-text">Pemesanan</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Hanya 4 langkah mudah untuk menikmati catering premium kami
                </p>
            </div>

            <!-- Steps Grid with Connecting Lines -->
            <div class="relative">
                <!-- Connecting Line (Desktop Only) -->
                <div class="hidden lg:block absolute top-10 left-0 right-0 h-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-indigo-200 via-green-200 via-orange-200 to-pink-200 dark:from-indigo-900/30 dark:via-green-900/30 dark:via-orange-900/30 dark:to-pink-900/30 rounded-full">
                    </div>
                    <!-- Animated Progress Line -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-green-500 via-orange-500 to-pink-500 rounded-full transform origin-left scale-x-0 animate-progress">
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 relative z-10">
                    <!-- Step 1: Pilih Menu -->
                    <div class="text-center group">
                        <div class="relative mb-6 inline-block">
                            <!-- Main Circle -->
                            <div
                                class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/40 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 relative z-10">
                                <!-- Menu/Food Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>

                            <!-- Step Number Badge -->
                            <div
                                class="absolute -top-2 -right-2 w-8 h-8 z-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm shadow-lg ring-4 ring-white dark:ring-gray-900 group-hover:scale-125 transition-transform duration-300">
                                1
                            </div>

                            <!-- Pulse Animation -->
                            <div class="absolute inset-0 rounded-full bg-indigo-500 animate-ping opacity-20"></div>
                        </div>

                        <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-white">Pilih Menu</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                            Jelajahi 50+ menu lezat dengan berbagai pilihan masakan
                        </p>

                        <!-- Hover Icon -->
                        <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 mx-auto text-indigo-600 dark:text-indigo-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Step 2: Tentukan Jadwal -->
                    <div class="text-center group">
                        <div class="relative mb-6 inline-block">
                            <div
                                class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-green-500/40 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 relative z-10">
                                <!-- Calendar Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>

                            <div
                                class="absolute -top-2 -right-2 w-8 h-8 z-10 rounded-full bg-green-600 text-white flex items-center justify-center font-bold text-sm shadow-lg ring-4 ring-white dark:ring-gray-900 group-hover:scale-125 transition-transform duration-300">
                                2
                            </div>

                            <div class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-20"></div>
                        </div>

                        <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-white">Tentukan Jadwal</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                            Pilih tanggal dan waktu pengiriman yang sesuai
                        </p>

                        <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 mx-auto text-green-600 dark:text-green-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Step 3: Bayar Mudah -->
                    <div class="text-center group">
                        <div class="relative mb-6 inline-block">
                            <div
                                class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center shadow-lg shadow-orange-500/40 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 relative z-10">
                                <!-- Credit Card Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>

                            <div
                                class="absolute -top-2 -right-2 w-8 h-8 z-10 rounded-full bg-orange-600 text-white flex items-center justify-center font-bold text-sm shadow-lg ring-4 ring-white dark:ring-gray-900 group-hover:scale-125 transition-transform duration-300">
                                3
                            </div>

                            <div class="absolute inset-0 rounded-full bg-orange-500 animate-ping opacity-20"></div>
                        </div>

                        <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-white">Bayar Mudah</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                            Transfer bank, e-wallet, atau bayar saat terima (COD)
                        </p>

                        <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 mx-auto text-orange-600 dark:text-orange-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Step 4: Terima & Nikmati -->
                    <div class="text-center group">
                        <div class="relative mb-6 inline-block">
                            <div
                                class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center shadow-lg shadow-pink-500/40 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 relative z-10">
                                <!-- Check/Success Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <div
                                class="absolute -top-2 -right-2 w-8 h-8 z-10 rounded-full bg-pink-600 text-white flex items-center justify-center font-bold text-sm shadow-lg ring-4 ring-white dark:ring-gray-900 group-hover:scale-125 transition-transform duration-300">
                                4
                            </div>

                            <div class="absolute inset-0 rounded-full bg-pink-500 animate-ping opacity-20"></div>
                        </div>

                        <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-white">Terima & Nikmati</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                            Makanan sampai tepat waktu dan siap dinikmati!
                        </p>

                        <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 mx-auto text-pink-600 dark:text-pink-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom CTA -->
            <div class="mt-16 text-center">
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Siap untuk memulai? Pesan sekarang dan nikmati pengalaman catering terbaik!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:shadow-2xl hover:shadow-indigo-500/50 hover:scale-105 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Mulai Pesan Sekarang</span>
                    </a>
                    <a href="#menu"
                        class="inline-flex items-center gap-2 px-8 py-4 rounded-full border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400 font-semibold hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>Lihat Menu</span>
                    </a>
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

        // Theme Switcher
        function toggleTheme() {
            const body = document.body;
            const sunIcon = document.getElementById('theme-icon-sun');
            const moonIcon = document.getElementById('theme-icon-moon');

            body.classList.toggle('light-mode');

            if (body.classList.contains('light-mode')) {
                localStorage.setItem('theme', 'light');
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                localStorage.setItem('theme', 'dark');
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        }

        // Load saved theme
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            const body = document.body;
            const sunIcon = document.getElementById('theme-icon-sun');
            const moonIcon = document.getElementById('theme-icon-moon');

            if (savedTheme === 'light') {
                body.classList.add('light-mode');
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        });

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const hamburger = document.getElementById('hamburger');

            menu.classList.toggle('active');
            hamburger.classList.toggle('active');
        }

        function closeMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const hamburger = document.getElementById('hamburger');

            menu.classList.remove('active');
            hamburger.classList.remove('active');
        }

        // Navbar scroll effect
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            const currentScroll = window.pageYOffset;

            if (currentScroll > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });
    </script>

</body>

</html>
