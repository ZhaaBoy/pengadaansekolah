<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">

        {{-- 🟣 CARD CONTAINER --}}
        <div
            class="w-full max-w-md bg-white rounded-lg shadow-lg hover:shadow-[0_15px_45px_rgba(139,92,246,0.35)] transition-all duration-500 ease-out transform hover:-translate-y-1 overflow-hidden border border-gray-100">

            {{-- 🟣 Decorative top line --}}
            <div class="h-2 bg-gradient-to-r from-purple-600 via-violet-500 to-fuchsia-500 rounded-t-[2rem]"></div>

            {{-- 🟣 Card Content --}}
            <div class="p-8">

                {{-- Logo + Heading di dalam card --}}
                <div class="flex flex-col items-center text-center mb-8">
                    <x-authentication-card-logo
                        class="h-20 w-auto mb-4 drop-shadow-[0_4px_6px_rgba(147,51,234,0.3)] rounded-full bg-white/90 p-2" />

                    <h2 class="text-3xl font-extrabold text-gray-800 leading-tight">
                        Sistem Pengadaan Barang <span class="text-purple-600">SDN Caringin I</span>
                    </h2>
                    <p class="text-gray-500 mt-2 text-sm sm:text-base">Silakan masuk untuk melanjutkan</p>
                </div>

                {{-- Error Messages --}}
                <x-validation-errors class="mb-4 mt-2" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-semibold" />
                        <x-input id="email"
                            class="block mt-1 w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm"
                            type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" />
                    </div>

                    {{-- Password --}}
                    <div class="mt-4 relative">
                        <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold" />
                        <x-input id="password"
                            class="block mt-1 w-full pr-10 rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm"
                            type="password" name="password" required autocomplete="current-password" />

                        {{-- Toggle Button --}}
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-3 mt-6 flex items-center text-gray-500 hover:text-purple-600 transition">
                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 opacity-100 transition-opacity duration-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943
                                    9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 opacity-0 absolute transition-opacity duration-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                                    c-4.477 0-8.268-2.943-9.542-7a9.956
                                    9.956 0 012.719-4.362M9.88 9.88a3 3 0
                                    104.24 4.24" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                            </svg>
                        </button>
                    </div>

                    {{-- Remember Me --}}
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember"
                                class="text-purple-600 focus:ring-purple-500 rounded" />
                            <span class="ms-2 text-sm text-gray-700">{{ __('Ingat saya') }}</span>
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between mt-6">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-purple-600 hover:text-purple-800 transition font-medium"
                                href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif

                        <x-button
                            class="bg-gradient-to-r from-purple-600 via-violet-500 to-fuchsia-500 hover:from-purple-700 hover:via-violet-600 hover:to-fuchsia-600 text-white px-6 py-2 rounded-xl font-semibold shadow-[0_4px_15px_rgba(147,51,234,0.4)] transition transform hover:scale-[1.03] focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            {{ __('Masuk') }}
                        </x-button>
                    </div>
                </form>

                {{-- Footer --}}
                <p class="mt-8 text-center text-xs text-gray-500">
                    © {{ date('Y') }} ZhaaBoy. Semua hak dilindungi.
                </p>
            </div>
        </div>
    </div>

    {{-- Script Toggle Password --}}
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');
            input.type = input.type === 'password' ? 'text' : 'password';
            eyeOpen.classList.toggle('opacity-0');
            eyeClosed.classList.toggle('opacity-0');
        }
    </script>
</x-guest-layout>
