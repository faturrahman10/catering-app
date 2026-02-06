<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeSwitcher()" :class="{ 'dark': dark }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi Email - {{ config('app.name', 'CateringApp') }}</title>

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

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
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

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
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
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3 mb-12 group">
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
                        Satu Langkah Lagi!<br>
                        <span class="gradient-text">Verifikasi Email Anda</span>
                    </h2>

                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Terima kasih telah mendaftar! Kami telah mengirimkan link verifikasi ke email Anda. Silakan
                        cek inbox atau folder spam.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-4 group">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">✉️</span>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Cek Email Anda</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Link verifikasi sudah dikirim ke
                                    inbox Anda</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 group">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">🔗</span>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Klik Link Verifikasi</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Klik link di email untuk
                                    mengaktifkan akun</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 group">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">🎉</span>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Mulai Memesan!</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Setelah verifikasi, langsung bisa
                                    pesan catering</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Email Illustration -->
                <div class="relative">
                    <div class="glass-effect rounded-2xl p-8 text-center">
                        <div
                            class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center animate-pulse">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Email verifikasi sedang menunggu di inbox Anda
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side - Verification Info -->
            <div class="animate-slide-in-right">
                <div class="glass-effect rounded-3xl p-8 md:p-12 shadow-2xl">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex items-center justify-center mb-8">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-xl">
                            <span class="text-white font-bold text-3xl">📧</span>
                        </div>
                    </div>

                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900/30 mb-4">
                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold mb-2">Verifikasi Email Anda</h2>
                        <p class="text-gray-600 dark:text-gray-400">
                            Terima kasih telah mendaftar! Kami telah mengirimkan link verifikasi ke email Anda.
                        </p>
                    </div>

                    <!-- Success Status -->
                    @if (session('status') == 'verification-link-sent')
                        <div
                            class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 animate-fade-in-up">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400 mt-0.5 mr-3 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-green-700 dark:text-green-300 mb-1">
                                        Link Verifikasi Terkirim!
                                    </p>
                                    <p class="text-sm text-green-600 dark:text-green-400">
                                        Link verifikasi baru telah dikirim ke alamat email yang Anda daftarkan. Silakan
                                        cek inbox atau folder spam Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Info Message -->
                    <div
                        class="mb-8 p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-blue-700 dark:text-blue-300">
                                <p class="font-semibold mb-1">Belum menerima email?</p>
                                <p class="text-xs mb-2">
                                    Jika Anda tidak menerima email dalam beberapa menit, silakan:
                                </p>
                                <ul class="text-xs space-y-1 ml-4">
                                    <li>• Cek folder spam atau junk mail Anda</li>
                                    <li>• Pastikan email yang didaftarkan benar</li>
                                    <li>• Klik tombol "Kirim Ulang" di bawah</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <!-- Resend Verification Email -->
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-[1.02] transition-all duration-300 shadow-lg hover:shadow-xl">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Kirim Ulang Email Verifikasi
                                </span>
                            </button>
                        </form>

                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full py-3.5 px-6 rounded-xl border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </span>
                            </button>
                        </form>
                    </div>

                    <!-- Help Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="text-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                Mengalami masalah dengan verifikasi email?
                            </p>
                            <a href="#"
                                class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                                Hubungi Tim Support Kami →
                            </a>
                        </div>
                    </div>

                    <!-- Email Tips -->
                    <div
                        class="mt-6 p-4 rounded-xl bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mt-0.5 mr-3 flex-shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div class="text-sm text-yellow-700 dark:text-yellow-300">
                                <p class="font-semibold mb-1">Tips Penting</p>
                                <p class="text-xs">
                                    Link verifikasi akan kedaluwarsa setelah 60 menit. Jika sudah kedaluwarsa, silakan
                                    klik "Kirim Ulang Email Verifikasi" untuk mendapatkan link baru.
                                </p>
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
