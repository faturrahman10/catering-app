<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeSwitcher()" :class="{ 'dark': dark }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - {{ config('app.name', 'CateringApp') }}</title>

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

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out forwards;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .glass-effect {
            background: rgba(17, 24, 39, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.3);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 text-gray-800 dark:text-gray-100 min-h-screen flex items-center justify-center p-4">

    <!-- Background Decoration -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-20 w-72 h-72 bg-indigo-400/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-400/20 rounded-full blur-3xl animate-float"
            style="animation-delay: 1s;"></div>
    </div>

    <!-- Main Container -->
    <div class="w-full max-w-6xl relative z-10">
        <div class="grid lg:grid-cols-2 gap-8 items-center">

            <!-- Left Side - Branding & Info -->
            <div class="hidden lg:block animate-fade-in-up space-y-8">
                <!-- Logo & Brand -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 mb-12 group">
                    <div
                        class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                        <span class="text-white font-bold text-2xl">🍽️</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold gradient-text">
                            {{ config('app.name', 'CateringApp') }}
                        </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Catering Premium Indonesia</p>
                    </div>
                </a>

                <!-- Info Section -->
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold leading-tight">
                        Jangan Khawatir,<br>
                        <span class="gradient-text">Kami Siap Membantu!</span>
                    </h2>

                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Lupa password adalah hal yang wajar. Kami akan mengirimkan link reset password ke email Anda
                        dalam hitungan detik.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-4 group">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">📧</span>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Proses Cepat & Aman</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Link reset dikirim langsung ke
                                    email Anda</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 group">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">⏱️</span>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Link Berlaku 60 Menit</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Untuk keamanan akun Anda</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 group">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">🔒</span>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Data Tetap Aman</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Password lama tetap berlaku sampai
                                    diganti</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="glass-effect rounded-2xl p-6">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Butuh Bantuan?</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                Jika Anda tidak menerima email, periksa folder spam atau hubungi tim support kami.
                            </p>
                            <a href="#"
                                class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                                Hubungi Support →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Forgot Password Form -->
            <div class="animate-slide-in-right">
                <div class="glass-effect rounded-3xl p-8 md:p-12 shadow-2xl">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex items-center justify-center mb-8">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-xl">
                            <span class="text-white font-bold text-3xl">🔑</span>
                        </div>
                    </div>

                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900/30 mb-4">
                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold mb-2">Lupa Password?</h2>
                        <p class="text-gray-600 dark:text-gray-400">
                            Tidak masalah! Masukkan email Anda dan kami akan mengirimkan link untuk reset password.
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div
                            class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400 mt-0.5 mr-3 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm text-green-700 dark:text-green-300">
                                    {{ session('status') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Forgot Password Form -->
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email"
                                class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
                                Email
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    required autofocus
                                    class="input-focus w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                    placeholder="nama@email.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-[1.02] transition-all duration-300 shadow-lg hover:shadow-xl">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Kirim Link Reset Password
                            </span>
                        </button>

                        <!-- Divider -->
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white dark:bg-gray-800 text-gray-500">atau</span>
                            </div>
                        </div>

                        <!-- Back to Login -->
                        <div class="text-center space-y-3">
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center text-sm font-semibold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors group">
                                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke Login
                            </a>

                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                Belum punya akun?
                                <a href="{{ route('register') }}"
                                    class="font-semibold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                                    Daftar sekarang
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Info Box -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="text-sm text-blue-700 dark:text-blue-300">
                                    <p class="font-semibold mb-1">Tips Keamanan</p>
                                    <ul class="space-y-1 text-xs">
                                        <li>• Link reset hanya berlaku 60 menit</li>
                                        <li>• Periksa folder spam jika tidak menerima email</li>
                                        <li>• Jangan bagikan link reset ke siapapun</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Theme Toggle (Mobile) -->
                <div class="mt-6 flex justify-center lg:hidden">
                    <button @click="toggle()"
                        class="p-3 rounded-xl glass-effect hover:bg-white/50 dark:hover:bg-gray-700/50 transition-all">
                        <svg x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Theme Toggle (Desktop) -->
        <div class="hidden lg:block absolute top-4 right-4">
            <button @click="toggle()"
                class="p-3 rounded-xl glass-effect hover:bg-white/50 dark:hover:bg-gray-700/50 transition-all">
                <svg x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Dark Mode Script -->
    <script>
        function themeSwitcher() {
            return {
                dark: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window
                    .matchMedia(
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
