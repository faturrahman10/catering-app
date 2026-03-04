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

        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Bounce Slow */
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
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
    <section id="paket"
        class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16 space-y-4">
                <div
                    class="inline-block px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-4">
                    Harga Terbaik
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                    Paket <span class="gradient-text">Terbaik Kami</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Pilih paket yang sesuai dengan kebutuhan dan budget Anda
                </p>
            </div>

            <!-- Pricing Cards -->
            <div class="grid md:grid-cols-3 gap-8 lg:gap-6">

                <!-- Basic Package -->
                <div
                    class="group relative rounded-3xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 p-8 hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2 transition-all duration-300">
                    <!-- Icon -->
                    <div class="text-center mb-6">
                        <div class="inline-block relative">
                            <div
                                class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <!-- Salad Bowl Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-2 mt-4 text-gray-900 dark:text-white">Paket Hemat</h3>
                        <div class="mb-2">
                            <span class="text-4xl font-bold gradient-text">25K</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">per porsi</p>
                    </div>

                    <!-- Features List -->
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">1 Nasi + 1 Lauk</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">1 Sayur</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">Gratis Ongkir</span>
                        </li>
                        <li class="flex items-start opacity-30">
                            <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-400 dark:text-gray-600">Minuman</span>
                        </li>
                    </ul>

                    <!-- CTA Button -->
                    <a href="{{ route('register') }}"
                        class="block w-full py-4 rounded-full border-2 border-indigo-600 dark:border-indigo-500 text-indigo-600 dark:text-indigo-400 font-semibold text-center hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500 group-hover:shadow-lg transition-all duration-300">
                        Pilih Paket
                    </a>
                </div>

                <!-- Popular Package (Featured) -->
                <div
                    class="group relative rounded-3xl bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 p-8 text-white transform md:scale-105 hover:scale-110 hover:shadow-2xl hover:shadow-indigo-500/30 transition-all duration-300 z-10">
                    <!-- Popular Badge -->
                    <div
                        class="absolute -top-4 left-1/2 -translate-x-1/2 px-6 py-2 rounded-full bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 font-bold text-sm shadow-lg">
                        ⭐ PALING POPULER
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>

                    <div class="relative z-10">
                        <!-- Icon -->
                        <div class="text-center mb-6">
                            <div class="inline-block relative">
                                <div
                                    class="w-20 h-20 mx-auto rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 border border-white/30">
                                    <!-- Bento Box Icon -->
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold mb-2 mt-4">Paket Komplit</h3>
                            <div class="mb-2">
                                <span class="text-4xl font-bold">40K</span>
                            </div>
                            <p class="text-indigo-100 text-sm">per porsi</p>
                        </div>

                        <!-- Features List -->
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-300 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-white">1 Nasi + 2 Lauk</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-300 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-white">1 Sayur + Buah</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-300 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-white">Gratis Ongkir</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-300 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-white">1 Minuman</span>
                            </li>
                        </ul>

                        <!-- CTA Button -->
                        <a href="{{ route('register') }}"
                            class="block w-full py-4 rounded-full bg-white text-indigo-600 font-semibold text-center hover:bg-gray-100 shadow-lg hover:shadow-xl transition-all duration-300">
                            Pilih Paket Ini
                        </a>
                    </div>
                </div>

                <!-- Premium Package -->
                <div
                    class="group relative rounded-3xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 p-8 hover:border-purple-500 dark:hover:border-purple-500 hover:shadow-2xl hover:shadow-purple-500/10 hover:-translate-y-2 transition-all duration-300">
                    <!-- Icon -->
                    <div class="text-center mb-6">
                        <div class="inline-block relative">
                            <div
                                class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center shadow-lg shadow-purple-500/30 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <!-- Crown Icon -->
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4" />
                                </svg>
                            </div>
                            <!-- Premium Badge -->
                            <div
                                class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow-lg">
                                <span class="text-white text-xs font-bold">★</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-2 mt-4 text-gray-900 dark:text-white">Paket Premium</h3>
                        <div class="mb-2">
                            <span class="text-4xl font-bold gradient-text">60K</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">per porsi</p>
                    </div>

                    <!-- Features List -->
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">1 Nasi + 3 Lauk Premium</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">2 Sayur + Buah</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">Gratis Ongkir</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">2 Minuman + Dessert</span>
                        </li>
                    </ul>

                    <!-- CTA Button -->
                    <a href="{{ route('register') }}"
                        class="block w-full py-4 rounded-full border-2 border-purple-600 dark:border-purple-500 text-purple-600 dark:text-purple-400 font-semibold text-center hover:bg-purple-600 hover:text-white dark:hover:bg-purple-500 group-hover:shadow-lg transition-all duration-300">
                        Pilih Paket
                    </a>
                </div>
            </div>

            <!-- Bottom Info -->
            <div class="mt-16 text-center space-y-6">
                <div class="flex flex-wrap justify-center gap-8 text-sm text-gray-600 dark:text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Tanpa biaya tersembunyi</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Bisa cancel kapan saja</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Garansi uang kembali</span>
                    </div>
                </div>

                <p class="text-gray-600 dark:text-gray-400">
                    Butuh paket custom? <a href="#"
                        class="text-indigo-600 dark:text-indigo-400 font-semibold hover:underline">Hubungi kami</a>
                </p>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section id="testimoni"
        class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16 space-y-4">
                <div
                    class="inline-block px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-4">
                    Testimoni
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                    Kata <span class="gradient-text">Pelanggan Kami</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Bergabung dengan ribuan pelanggan yang puas dengan layanan kami
                </p>

                <!-- Stats -->
                <div class="flex flex-wrap justify-center gap-8 mt-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">1000+</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Pelanggan Aktif</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">4.9/5</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Rating Google</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">98%</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Kepuasan</div>
                    </div>
                </div>
            </div>

            <!-- Carousel Wrapper -->
            <div class="relative max-w-6xl mx-auto">
                <!-- Left Arrow -->
                <button onclick="prevTestimonial()"
                    class="hidden lg:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-6 z-20 w-12 h-12 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 items-center justify-center hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:border-indigo-500 transition-all shadow-lg">
                    <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Right Arrow -->
                <button onclick="nextTestimonial()"
                    class="hidden lg:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-6 z-20 w-12 h-12 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 items-center justify-center hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:border-indigo-500 transition-all shadow-lg">
                    <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Carousel Container -->
                <div class="overflow-hidden" id="testimonialCarousel">
                    <div class="flex transition-transform duration-700 ease-in-out" id="testimonialTrack">

                        <!-- Testimonial 1 -->
                        <div class="flex-shrink-0 w-full px-3">
                            <div class="max-w-4xl mx-auto">
                                <div
                                    class="group relative p-8 lg:p-10 rounded-3xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-300">
                                    <!-- Quote Icon -->
                                    <div
                                        class="absolute top-4 right-4 w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                        </svg>
                                    </div>

                                    <!-- Profile -->
                                    <div class="flex items-center mb-6">
                                        <div class="relative">
                                            <div
                                                class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg ring-4 ring-white dark:ring-gray-800">
                                                A
                                            </div>
                                            <div
                                                class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-green-500 flex items-center justify-center ring-2 ring-white dark:ring-gray-800">
                                                <svg class="w-4 h-4 text-white" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-bold text-lg text-gray-900 dark:text-white">Ani Setiawati
                                            </div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">Ibu Rumah Tangga
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rating -->
                                    <div class="flex items-center gap-1 mb-4">
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span
                                            class="ml-2 text-sm font-semibold text-gray-700 dark:text-gray-300">5.0</span>
                                    </div>

                                    <!-- Testimonial Text -->
                                    <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed italic">
                                        "Menu variatif dan rasanya enak banget! Anak-anak saya suka semua. Pengantaran
                                        juga selalu tepat waktu. Recommended!"
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="flex-shrink-0 w-full px-3">
                            <div class="max-w-4xl mx-auto">
                                <div
                                    class="group relative p-8 lg:p-10 rounded-3xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-500 hover:shadow-2xl hover:shadow-green-500/10 transition-all duration-300">
                                    <div
                                        class="absolute top-4 right-4 w-12 h-12 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                        </svg>
                                    </div>

                                    <div class="flex items-center mb-6">
                                        <div class="relative">
                                            <div
                                                class="w-16 h-16 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white font-bold text-xl shadow-lg ring-4 ring-white dark:ring-gray-800">
                                                B
                                            </div>
                                            <div
                                                class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-green-500 flex items-center justify-center ring-2 ring-white dark:ring-gray-800">
                                                <svg class="w-4 h-4 text-white" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-bold text-lg text-gray-900 dark:text-white">Budi Santoso
                                            </div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">Karyawan Swasta</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1 mb-4">
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span
                                            class="ml-2 text-sm font-semibold text-gray-700 dark:text-gray-300">5.0</span>
                                    </div>

                                    <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed italic">
                                        "Sangat membantu untuk makan siang di kantor. Harganya terjangkau tapi
                                        kualitasnya premium. Pelayanan juga ramah!"
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="flex-shrink-0 w-full px-3">
                            <div class="max-w-4xl mx-auto">
                                <div
                                    class="group relative p-8 lg:p-10 rounded-3xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 hover:border-pink-500 dark:hover:border-pink-500 hover:shadow-2xl hover:shadow-pink-500/10 transition-all duration-300">
                                    <div
                                        class="absolute top-4 right-4 w-12 h-12 rounded-full bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                        </svg>
                                    </div>

                                    <div class="flex items-center mb-6">
                                        <div class="relative">
                                            <div
                                                class="w-16 h-16 rounded-full bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center text-white font-bold text-xl shadow-lg ring-4 ring-white dark:ring-gray-800">
                                                C
                                            </div>
                                            <div
                                                class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-green-500 flex items-center justify-center ring-2 ring-white dark:ring-gray-800">
                                                <svg class="w-4 h-4 text-white" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-bold text-lg text-gray-900 dark:text-white">Citra Dewi
                                            </div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">Pengusaha</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1 mb-4">
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span
                                            class="ml-2 text-sm font-semibold text-gray-700 dark:text-gray-300">5.0</span>
                                    </div>

                                    <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed italic">
                                        "Sudah langganan 6 bulan. Menu selalu fresh dan higienis. Sistemnya juga mudah,
                                        tinggal order lewat app!"
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Dots Indicator - Small & Clean -->
                <div class="flex justify-center gap-2 mt-8" id="dotsIndicator">
                    <button onclick="goToTestimonial(0)"
                        class="dot w-2 h-2 rounded-full bg-indigo-600 transition-all duration-300"></button>
                    <button onclick="goToTestimonial(1)"
                        class="dot w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-700 transition-all duration-300"></button>
                    <button onclick="goToTestimonial(2)"
                        class="dot w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-700 transition-all duration-300"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- MENU PREVIEW -->
    <section id="menu"
        class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16 space-y-4">
                <div
                    class="inline-block px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-4">
                    Menu Favorit
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                    Menu <span class="gradient-text">Favorit Minggu Ini</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Pilihan menu terpopuler dari pelanggan kami dengan cita rasa autentik
                </p>
            </div>

            <!-- Menu Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

                <!-- Menu Item 1: Ayam Geprek -->
                <div
                    class="group relative rounded-3xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 overflow-hidden hover:border-orange-500 dark:hover:border-orange-500 hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-2 transition-all duration-300">
                    <!-- Popular Badge -->
                    <div
                        class="absolute top-4 right-4 z-10 flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs font-bold shadow-lg">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                        <span>Popular</span>
                    </div>

                    <!-- Image Container -->
                    <div
                        class="relative aspect-square bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 flex items-center justify-center overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                <pattern id="dots-1" x="0" y="0" width="20" height="20"
                                    patternUnits="userSpaceOnUse">
                                    <circle cx="2" cy="2" r="1" fill="currentColor" />
                                </pattern>
                                <rect width="100%" height="100%" fill="url(#dots-1)" />
                            </svg>
                        </div>

                        <!-- Icon with Animation -->
                        <div
                            class="relative z-10 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-32 h-32 text-orange-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>

                        <!-- Hover Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-white">Ayam Geprek</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Ayam crispy dengan sambal level
                            pilihan</p>

                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="text-2xl font-bold text-orange-600">35K</div>
                                <div class="text-xs text-gray-500">per porsi</div>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">4.8</span>
                            </div>
                        </div>

                        <!-- Add to Cart Button (appears on hover) -->
                        <button
                            class="w-full py-3 rounded-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 shadow-lg">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                <!-- Menu Item 2: Soto Ayam -->
                <div
                    class="group relative rounded-3xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 overflow-hidden hover:border-green-500 dark:hover:border-green-500 hover:shadow-2xl hover:shadow-green-500/10 hover:-translate-y-2 transition-all duration-300">
                    <!-- Rating Badge -->
                    <div
                        class="absolute top-4 right-4 z-10 flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs font-bold shadow-lg">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span>4.9</span>
                    </div>

                    <div
                        class="relative aspect-square bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                <pattern id="dots-2" x="0" y="0" width="20" height="20"
                                    patternUnits="userSpaceOnUse">
                                    <circle cx="2" cy="2" r="1" fill="currentColor" />
                                </pattern>
                                <rect width="100%" height="100%" fill="url(#dots-2)" />
                            </svg>
                        </div>

                        <div
                            class="relative z-10 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-32 h-32 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-green-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-white">Soto Ayam</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Soto ayam kuah gurih nikmat hangat</p>

                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="text-2xl font-bold text-green-600">30K</div>
                                <div class="text-xs text-gray-500">per porsi</div>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">4.9</span>
                            </div>
                        </div>

                        <button
                            class="w-full py-3 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 shadow-lg">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                <!-- Menu Item 3: Rendang Sapi -->
                <div
                    class="group relative rounded-3xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 overflow-hidden hover:border-red-500 dark:hover:border-red-500 hover:shadow-2xl hover:shadow-red-500/10 hover:-translate-y-2 transition-all duration-300">
                    <!-- Premium Badge -->
                    <div
                        class="absolute top-4 right-4 z-10 flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-bold shadow-lg">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span>Premium</span>
                    </div>

                    <div
                        class="relative aspect-square bg-gradient-to-br from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                <pattern id="dots-3" x="0" y="0" width="20" height="20"
                                    patternUnits="userSpaceOnUse">
                                    <circle cx="2" cy="2" r="1" fill="currentColor" />
                                </pattern>
                                <rect width="100%" height="100%" fill="url(#dots-3)" />
                            </svg>
                        </div>

                        <div
                            class="relative z-10 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-32 h-32 text-red-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-white">Rendang Sapi</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Rendang empuk bumbu meresap sempurna
                        </p>

                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="text-2xl font-bold text-red-600">45K</div>
                                <div class="text-xs text-gray-500">per porsi</div>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">5.0</span>
                            </div>
                        </div>

                        <button
                            class="w-full py-3 rounded-full bg-gradient-to-r from-red-500 to-pink-500 text-white font-semibold opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 shadow-lg">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

                <!-- Menu Item 4: Nasi Goreng -->
                <div
                    class="group relative rounded-3xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 overflow-hidden hover:border-yellow-500 dark:hover:border-yellow-500 hover:shadow-2xl hover:shadow-yellow-500/10 hover:-translate-y-2 transition-all duration-300">
                    <!-- Hemat Badge -->
                    <div
                        class="absolute top-4 right-4 z-10 flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-xs font-bold shadow-lg">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Hemat</span>
                    </div>

                    <div
                        class="relative aspect-square bg-gradient-to-br from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                <pattern id="dots-4" x="0" y="0" width="20" height="20"
                                    patternUnits="userSpaceOnUse">
                                    <circle cx="2" cy="2" r="1" fill="currentColor" />
                                </pattern>
                                <rect width="100%" height="100%" fill="url(#dots-4)" />
                            </svg>
                        </div>

                        <div
                            class="relative z-10 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-32 h-32 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-yellow-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-white">Nasi Goreng</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Nasi goreng spesial komplit mantap</p>

                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="text-2xl font-bold text-yellow-600">28K</div>
                                <div class="text-xs text-gray-500">per porsi</div>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">4.7</span>
                            </div>
                        </div>

                        <button
                            class="w-full py-3 rounded-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white font-semibold opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 shadow-lg">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>

            </div>

            <!-- CTA Button -->
            <div class="text-center mt-16">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:shadow-2xl hover:shadow-indigo-500/50 hover:scale-105 transition-all duration-300">
                    <span>Lihat Semua Menu</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Animated Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600"></div>

        <!-- Animated Background Blobs -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-20 w-72 h-72 bg-white rounded-full blur-3xl animate-blob"></div>
            <div
                class="absolute top-40 right-20 w-96 h-96 bg-white rounded-full blur-3xl animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-20 left-40 w-80 h-80 bg-white rounded-full blur-3xl animate-blob animation-delay-4000">
            </div>
        </div>

        <!-- Decorative Grid Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-pattern" x="0" y="0" width="40" height="40"
                        patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-pattern)" class="text-white" />
            </svg>
        </div>

        <div class="max-w-5xl mx-auto relative z-10">
            <!-- Badge with Icon -->
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/20 backdrop-blur-sm text-white text-sm font-bold border border-white/30 shadow-lg animate-bounce-slow">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span>Promo Spesial Pelanggan Baru</span>
                </div>
            </div>

            <!-- Main Heading -->
            <div class="text-center mb-8">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Siap Nikmati Makanan Enak
                    <span
                        class="block mt-2 bg-clip-text text-transparent bg-gradient-to-r from-yellow-200 to-orange-300">
                        Tanpa Ribet?
                    </span>
                </h2>
                <p class="text-xl text-white/90 mb-4 max-w-2xl mx-auto leading-relaxed">
                    Daftar sekarang dan dapatkan diskon <span class="font-bold text-yellow-300">20%</span> untuk
                    pemesanan pertama Anda!
                </p>
                <p class="text-base text-white/80 max-w-xl mx-auto">
                    Tidak ada biaya tersembunyi, gratis ongkir area tertentu.
                </p>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <a href="{{ route('register') }}"
                    class="group relative px-10 py-5 rounded-full bg-white text-indigo-600 font-bold hover:bg-gray-50 transition-all duration-300 shadow-2xl hover:shadow-white/50 hover:scale-105 overflow-hidden">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Daftar & Dapat Diskon 20%
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </span>
                    <!-- Shine Effect -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                    </div>
                </a>

                <a href="#menu"
                    class="group px-10 py-5 rounded-full border-2 border-white text-white font-bold hover:bg-white/10 backdrop-blur-sm transition-all duration-300 hover:scale-105">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Menu Dulu
                        <svg class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="grid sm:grid-cols-3 gap-6 max-w-3xl mx-auto">
                <!-- Badge 1 -->
                <div
                    class="group relative p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                    <div
                        class="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="relative z-10 text-center">
                        <div
                            class="w-12 h-12 mx-auto mb-3 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="text-white font-bold mb-1">Gratis Ongkir</div>
                        <div class="text-white/70 text-sm">Area tertentu</div>
                    </div>
                </div>

                <!-- Badge 2 -->
                <div
                    class="group relative p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                    <div
                        class="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="relative z-10 text-center">
                        <div
                            class="w-12 h-12 mx-auto mb-3 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-white font-bold mb-1">Cancel Anytime</div>
                        <div class="text-white/70 text-sm">Tanpa biaya</div>
                    </div>
                </div>

                <!-- Badge 3 -->
                <div
                    class="group relative p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                    <div
                        class="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="relative z-10 text-center">
                        <div
                            class="w-12 h-12 mx-auto mb-3 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="text-white font-bold mb-1">Garansi 100%</div>
                        <div class="text-white/70 text-sm">Uang kembali</div>
                    </div>
                </div>
            </div>

            <!-- Social Proof -->
            <div class="mt-12 text-center">
                <div
                    class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-white/10 backdrop-blur-sm border border-white/20">
                    <div class="flex -space-x-2">
                        <div
                            class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-400 to-purple-600 border-2 border-white flex items-center justify-center text-white text-xs font-bold">
                            A</div>
                        <div
                            class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-emerald-600 border-2 border-white flex items-center justify-center text-white text-xs font-bold">
                            B</div>
                        <div
                            class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-red-600 border-2 border-white flex items-center justify-center text-white text-xs font-bold">
                            C</div>
                        <div
                            class="w-8 h-8 rounded-full bg-gradient-to-br from-pink-400 to-rose-600 border-2 border-white flex items-center justify-center text-white text-xs font-bold">
                            +</div>
                    </div>
                    <div class="text-white text-sm">
                        <span class="font-bold">1000+ pelanggan</span> sudah bergabung minggu ini
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section
        class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-4xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16 space-y-4">
                <div
                    class="inline-block px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-4">
                    FAQ
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                    Pertanyaan <span class="gradient-text">yang Sering Diajukan</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Temukan jawaban untuk pertanyaan yang paling sering ditanyakan tentang layanan kami
                </p>
            </div>

            <!-- FAQ Accordion -->
            <div class="space-y-4" x-data="{ active: null }">

                <!-- FAQ Item 1 -->
                <div class="group rounded-2xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 overflow-hidden hover:border-indigo-500 dark:hover:border-indigo-500 hover:shadow-xl transition-all duration-300"
                    :class="{ 'border-indigo-500 dark:border-indigo-500 shadow-xl': active === 1 }">
                    <button @click="active = active === 1 ? null : 1"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                        <div class="flex items-center gap-4">
                            <!-- Icon -->
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center transition-transform duration-300"
                                :class="{ 'scale-110 rotate-3': active === 1 }">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <span class="font-bold text-lg text-left text-gray-900 dark:text-white">Bagaimana cara
                                memesan catering?</span>
                        </div>
                        <!-- Arrow Icon -->
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400 transition-transform duration-300 flex-shrink-0 ml-4"
                            :class="{ 'rotate-180': active === 1 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-6 pb-5">
                        <div class="pl-14 pr-4 text-gray-600 dark:text-gray-400 leading-relaxed">
                            Sangat mudah! Cukup daftar akun, pilih menu favorit Anda, tentukan jadwal pengiriman, lalu
                            lakukan pembayaran. Tim kami akan mengantarkan pesanan tepat waktu.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="group rounded-2xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 overflow-hidden hover:border-green-500 dark:hover:border-green-500 hover:shadow-xl transition-all duration-300"
                    :class="{ 'border-green-500 dark:border-green-500 shadow-xl': active === 2 }">
                    <button @click="active = active === 2 ? null : 2"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center transition-transform duration-300"
                                :class="{ 'scale-110 rotate-3': active === 2 }">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="font-bold text-lg text-left text-gray-900 dark:text-white">Apakah ada minimum
                                order?</span>
                        </div>
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400 transition-transform duration-300 flex-shrink-0 ml-4"
                            :class="{ 'rotate-180': active === 2 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-6 pb-5">
                        <div class="pl-14 pr-4 text-gray-600 dark:text-gray-400 leading-relaxed">
                            Untuk pemesanan harian, minimum order 1 porsi. Untuk paket bulanan atau acara khusus,
                            silakan
                            hubungi CS kami untuk penawaran terbaik.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="group rounded-2xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 overflow-hidden hover:border-orange-500 dark:hover:border-orange-500 hover:shadow-xl transition-all duration-300"
                    :class="{ 'border-orange-500 dark:border-orange-500 shadow-xl': active === 3 }">
                    <button @click="active = active === 3 ? null : 3"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center transition-transform duration-300"
                                :class="{ 'scale-110 rotate-3': active === 3 }">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="font-bold text-lg text-left text-gray-900 dark:text-white">Area mana saja
                                yang dilayani?</span>
                        </div>
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400 transition-transform duration-300 flex-shrink-0 ml-4"
                            :class="{ 'rotate-180': active === 3 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-6 pb-5">
                        <div class="pl-14 pr-4 text-gray-600 dark:text-gray-400 leading-relaxed">
                            Kami melayani seluruh wilayah Jakarta, Bogor, Depok, Tangerang, dan Bekasi. Untuk area lain,
                            silakan hubungi CS kami.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="group rounded-2xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 overflow-hidden hover:border-red-500 dark:hover:border-red-500 hover:shadow-xl transition-all duration-300"
                    :class="{ 'border-red-500 dark:border-red-500 shadow-xl': active === 4 }">
                    <button @click="active = active === 4 ? null : 4"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center transition-transform duration-300"
                                :class="{ 'scale-110 rotate-3': active === 4 }">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <span class="font-bold text-lg text-left text-gray-900 dark:text-white">Bagaimana jika
                                saya ingin cancel pesanan?</span>
                        </div>
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400 transition-transform duration-300 flex-shrink-0 ml-4"
                            :class="{ 'rotate-180': active === 4 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 4" x-collapse class="px-6 pb-5">
                        <div class="pl-14 pr-4 text-gray-600 dark:text-gray-400 leading-relaxed">
                            Pembatalan dapat dilakukan maksimal H-1 sebelum jadwal pengiriman. Pembatalan pada hari yang
                            sama tidak dapat dilakukan.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 - NEW -->
                <div class="group rounded-2xl bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 overflow-hidden hover:border-purple-500 dark:hover:border-purple-500 hover:shadow-xl transition-all duration-300"
                    :class="{ 'border-purple-500 dark:border-purple-500 shadow-xl': active === 5 }">
                    <button @click="active = active === 5 ? null : 5"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center transition-transform duration-300"
                                :class="{ 'scale-110 rotate-3': active === 5 }">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <span class="font-bold text-lg text-left text-gray-900 dark:text-white">Metode pembayaran
                                apa saja yang tersedia?</span>
                        </div>
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400 transition-transform duration-300 flex-shrink-0 ml-4"
                            :class="{ 'rotate-180': active === 5 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 5" x-collapse class="px-6 pb-5">
                        <div class="pl-14 pr-4 text-gray-600 dark:text-gray-400 leading-relaxed">
                            Kami menerima pembayaran melalui transfer bank (BCA, Mandiri, BRI), e-wallet (GoPay, OVO,
                            Dana), dan Cash on Delivery (COD) untuk area tertentu.
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom CTA -->
            <div
                class="mt-16 text-center p-8 rounded-3xl bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 border-2 border-indigo-200 dark:border-indigo-800">
                <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Masih ada pertanyaan?</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Tim customer service kami siap membantu Anda 24/7
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:shadow-xl hover:shadow-indigo-500/50 hover:scale-105 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span>Chat dengan Kami</span>
                    </a>
                    <a href="#"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-indigo-600 dark:border-indigo-500 text-indigo-600 dark:text-indigo-400 font-semibold hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Email Kami</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="relative bg-gray-900 text-gray-300 py-16 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="footer-pattern" x="0" y="0" width="40" height="40"
                        patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#footer-pattern)" class="text-white" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <!-- Main Footer Content -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

                <!-- Company Info -->
                <div class="lg:col-span-1">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3 mb-6 group cursor-pointer">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500 flex items-center justify-center shadow-lg group-hover:shadow-indigo-500/50 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">
                            {{ config('app.name', 'CateringApp') }}
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="text-sm leading-relaxed mb-6 text-gray-400">
                        Solusi catering praktis dengan menu variatif dan kualitas terjamin untuk kebutuhan harian Anda.
                    </p>

                    <!-- Social Media -->
                    <div class="flex space-x-3">
                        <a href="#"
                            class="group w-10 h-10 rounded-full bg-gray-800 hover:bg-gradient-to-br hover:from-blue-600 hover:to-blue-700 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/50">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="group w-10 h-10 rounded-full bg-gray-800 hover:bg-gradient-to-br hover:from-pink-600 hover:to-rose-700 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-pink-500/50">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="group w-10 h-10 rounded-full bg-gray-800 hover:bg-gradient-to-br hover:from-green-600 hover:to-emerald-700 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-green-500/50">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="group w-10 h-10 rounded-full bg-gray-800 hover:bg-gradient-to-br hover:from-blue-400 hover:to-blue-600 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/50">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6 relative inline-block">
                        Menu
                        <span
                            class="absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600"></span>
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#menu"
                                class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Menu Harian</span>
                            </a>
                        </li>
                        <li>
                            <a href="#paket"
                                class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Paket Catering</span>
                            </a>
                        </li>
                        <li>
                            <a href="#cara-kerja"
                                class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Cara Pesan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#testimoni"
                                class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Testimoni</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6 relative inline-block">
                        Bantuan
                        <span
                            class="absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600"></span>
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#"
                                class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>FAQ</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Syarat & Ketentuan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Kebijakan Privasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-indigo-500 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Hubungi Kami</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6 relative inline-block">
                        Kontak
                        <span
                            class="absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600"></span>
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start group">
                            <div
                                class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-800 group-hover:bg-indigo-600 flex items-center justify-center transition-all duration-300">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-400 group-hover:text-white transition-colors">Jl. Contoh
                                    No. 123, Jakarta Selatan, Indonesia 12345</p>
                            </div>
                        </li>
                        <li class="flex items-start group">
                            <div
                                class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-800 group-hover:bg-indigo-600 flex items-center justify-center transition-all duration-300">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-400 group-hover:text-white transition-colors">
                                    cateringmama@gmail.com</p>
                            </div>
                        </li>
                        <li class="flex items-start group">
                            <div
                                class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-800 group-hover:bg-indigo-600 flex items-center justify-center transition-all duration-300">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-400 group-hover:text-white transition-colors">+62
                                    081234567890</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter -->
            <div
                class="mb-12 p-8 rounded-3xl bg-gradient-to-br from-indigo-600/10 to-purple-600/10 border border-indigo-500/20">
                <div class="max-w-2xl mx-auto text-center">
                    <h3 class="text-2xl font-bold text-white mb-3">Dapatkan Promo & Update Terbaru</h3>
                    <p class="text-gray-400 mb-6">Berlangganan newsletter kami dan dapatkan diskon spesial setiap
                        bulan</p>
                    <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                        <input type="email" placeholder="Email Anda"
                            class="flex-1 px-6 py-3 rounded-full bg-gray-800 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 transition-colors">
                        <button
                            class="px-8 py-3 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:shadow-lg hover:shadow-indigo-500/50 hover:scale-105 transition-all duration-300">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-400 text-center md:text-left">
                        <p>© {{ date('Y') }} <span
                                class="text-white font-semibold">{{ config('app.name') }}</span>. All rights
                            reserved.</p>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-400">
                        <span>Made with</span>
                        <svg class="w-4 h-4 text-red-500 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>in Indonesia</span>
                    </div>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Privacy
                            Policy</a>
                        <span class="text-gray-700">•</span>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Terms of
                            Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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

            // Initialize testimonial carousel
            initTestimonialCarousel();
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

        // ========================================
        // TESTIMONIAL CAROUSEL - SIMPLIFIED
        // ========================================
        let currentTestimonial = 0;
        const totalTestimonials = 3;
        let autoplayInterval;

        function updateCarousel() {
            const track = document.getElementById('testimonialTrack');
            const dots = document.querySelectorAll('.dot');

            if (!track || !dots.length) return;

            // Always show 1 card at a time (full width)
            track.style.transform = `translateX(-${currentTestimonial * 100}%)`;

            // Update dots
            dots.forEach((dot, index) => {
                if (index === currentTestimonial) {
                    dot.classList.remove('bg-gray-300', 'dark:bg-gray-700', 'w-2');
                    dot.classList.add('bg-indigo-600', 'w-6');
                } else {
                    dot.classList.remove('bg-indigo-600', 'w-6');
                    dot.classList.add('bg-gray-300', 'dark:bg-gray-700', 'w-2');
                }
            });
        }

        function nextTestimonial() {
            currentTestimonial = (currentTestimonial + 1) % totalTestimonials;
            updateCarousel();
            resetAutoplay();
        }

        function prevTestimonial() {
            currentTestimonial = (currentTestimonial - 1 + totalTestimonials) % totalTestimonials;
            updateCarousel();
            resetAutoplay();
        }

        function goToTestimonial(index) {
            currentTestimonial = index;
            updateCarousel();
            resetAutoplay();
        }

        function startAutoplay() {
            autoplayInterval = setInterval(nextTestimonial, 5000);
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        function resetAutoplay() {
            stopAutoplay();
            startAutoplay();
        }

        function initTestimonialCarousel() {
            const carousel = document.getElementById('testimonialCarousel');

            if (!carousel) return;

            updateCarousel();
            startAutoplay();

            carousel.addEventListener('mouseenter', stopAutoplay);
            carousel.addEventListener('mouseleave', startAutoplay);
        }
    </script>

</body>

</html>
