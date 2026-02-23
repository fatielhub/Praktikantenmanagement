<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-bold text-slate-700 ml-1">
                <i class="fa-solid fa-envelope mr-1 opacity-50"></i> {{ __('Email') }}
            </label>
            <div class="relative">
                <input id="email" 
                       class="block w-full px-4 py-3.5 bg-white/50 border border-slate-200 rounded-2xl text-slate-900 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium placeholder:text-slate-400" 
                       type="email" 
                       name="email" 
                       placeholder="votre.email@ump.ac.ma"
                       :value="old('email')" 
                       required 
                       autofocus 
                       autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs font-bold text-red-500 ml-1" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex items-center justify-between ml-1">
                <label for="password" class="block text-sm font-bold text-slate-700">
                    <i class="fa-solid fa-lock mr-1 opacity-50"></i> {{ __('Mot de passe') }}
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-primary hover:text-blue-800 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Oublié ?') }}
                    </a>
                @endif
            </div>
            <div class="relative" x-data="{ show: false }">
                <input id="password" 
                       class="block w-full px-4 py-3.5 bg-white/50 border border-slate-200 rounded-2xl text-slate-900 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium placeholder:text-slate-400"
                       :type="show ? 'text' : 'password'"
                       name="password"
                       placeholder="••••••••"
                       required 
                       autocomplete="current-password" />
                <button type="button" 
                        @click="show = !show" 
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs font-bold text-red-500 ml-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center ml-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <div class="relative flex items-center">
                    <input id="remember_me" type="checkbox" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-slate-300 transition-all checked:bg-primary checked:border-primary" name="remember">
                    <i class="fa-solid fa-check absolute w-5 text-center text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></i>
                </div>
                <span class="ms-3 text-sm font-semibold text-slate-600 group-hover:text-slate-900 transition-colors">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center gap-3 py-4 bg-[#1e3a8a] hover:bg-[#152e75] text-white rounded-2xl font-bold text-lg shadow-xl shadow-blue-900/20 transform transition-all hover:-translate-y-1 active:scale-95">
                <span>{{ __('Connexion') }}</span>
                <i class="fa-solid fa-arrow-right-to-bracket text-sm opacity-70"></i>
            </button>
        </div>

        @if (Route::has('register'))
            <div class="text-center mt-6">
                <p class="text-sm text-slate-500 font-medium">
                    Besoin d'un compte ? 
                    <a href="{{ route('register') }}" class="text-primary font-bold hover:underline ml-1">S'inscrire</a>
                </p>
            </div>
        @endif
    </form>
</x-guest-layout>
