<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeSwitcher()" :class="{ 'dark': dark }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - {{ config('app.name', 'CateringApp') }}</title>

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
                        Buat Password<br>
                        <span class="gradient-text">Baru yang Aman</span>
                    </h2>

                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Pastikan password baru Anda kuat dan mudah diingat. Password yang baik menggunakan kombinasi
                        huruf, angka, dan simbol.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-4 group">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">🔐</span>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Password Kuat</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Minimal 8 karakter dengan kombinasi
                                    huruf & angka</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 group">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">✅</span>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Mudah Diingat</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Gunakan kata yang berarti untuk Anda
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 group">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">🚫</span>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Jangan Gunakan Ulang</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Buat password unik untuk setiap
                                    akun</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Box -->
                <div class="glass-effect rounded-2xl p-6">
                    <div class="flex items-start space-x-3">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1 text-sm">Tips Password Kuat</h3>
                            <ul class="text-xs text-gray-600 dark:text-gray-400 space-y-1">
                                <li>• Gunakan minimal 8 karakter</li>
                                <li>• Kombinasikan huruf besar & kecil</li>
                                <li>• Tambahkan angka dan simbol (!@#$%)</li>
                                <li>• Hindari informasi pribadi (nama, tanggal lahir)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Reset Password Form -->
            <div class="animate-slide-in-right">
                <div class="glass-effect rounded-3xl p-8 md:p-12 shadow-2xl">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex items-center justify-center mb-8">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-xl">
                            <span class="text-white font-bold text-3xl">🔒</span>
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
                        <h2 class="text-3xl font-bold mb-2">Reset Password</h2>
                        <p class="text-gray-600 dark:text-gray-400">
                            Masukkan password baru untuk akun Anda
                        </p>
                    </div>

                    <!-- Reset Password Form -->
                    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                                <input id="email" type="email" name="email"
                                    value="{{ old('email', $request->email) }}" required autofocus
                                    autocomplete="username"
                                    class="input-focus w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                    placeholder="nama@email.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password"
                                class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
                                Password Baru
                            </label>
                            <div class="relative" x-data="{ show: false }">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" :type="show ? 'text' : 'password'" name="password" required
                                    autocomplete="new-password"
                                    class="input-focus w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                    placeholder="Minimal 8 karakter">
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">
                                Konfirmasi Password Baru
                            </label>
                            <div class="relative" x-data="{ show: false }">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <input id="password_confirmation" :type="show ? 'text' : 'password'"
                                    name="password_confirmation" required autocomplete="new-password"
                                    class="input-focus w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                    placeholder="Ulangi password baru">
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-[1.02] transition-all duration-300 shadow-lg hover:shadow-xl">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Reset Password
                            </span>
                        </button>
                    </form>

                    <!-- Security Info -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400 mt-0.5 mr-3 flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <div class="text-sm text-green-700 dark:text-green-300">
                                    <p class="font-semibold mb-1">Akun Anda Aman</p>
                                    <p class="text-xs">Setelah reset password berhasil, Anda akan diarahkan ke halaman
                                        login untuk masuk dengan password baru.</p>
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
