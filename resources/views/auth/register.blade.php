<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div class="space-y-1.5">
            <label for="name" class="block text-sm font-bold text-slate-700 ml-1">
                <i class="fa-solid fa-user mr-1 opacity-50"></i> {{ __('Nom Complet') }}
            </label>
            <input id="name" class="block w-full px-4 py-3 bg-white/50 border border-slate-200 rounded-2xl text-slate-900 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium placeholder:text-slate-400 text-sm" type="text" name="name" :value="old('name')" placeholder="Votre nom" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs font-bold text-red-500 ml-1" />
        </div>

        <!-- Email Address -->
        <div class="space-y-1.5">
            <label for="email" class="block text-sm font-bold text-slate-700 ml-1">
                <i class="fa-solid fa-envelope mr-1 opacity-50"></i> {{ __('Email') }}
            </label>
            <input id="email" class="block w-full px-4 py-3 bg-white/50 border border-slate-200 rounded-2xl text-slate-900 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium placeholder:text-slate-400 text-sm" type="email" name="email" :value="old('email')" placeholder="email@ump.ac.ma" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs font-bold text-red-500 ml-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
            <label for="password" class="block text-sm font-bold text-slate-700 ml-1">
                <i class="fa-solid fa-lock mr-1 opacity-50"></i> {{ __('Mot de passe') }}
            </label>
            <input id="password" class="block w-full px-4 py-3 bg-white/50 border border-slate-200 rounded-2xl text-slate-900 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium placeholder:text-slate-400 text-sm"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs font-bold text-red-500 ml-1" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1.5">
            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 ml-1">
                <i class="fa-solid fa-shield-check mr-1 opacity-50"></i> {{ __('Confirmer') }}
            </label>
            <input id="password_confirmation" class="block w-full px-4 py-3 bg-white/50 border border-slate-200 rounded-2xl text-slate-900 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium placeholder:text-slate-400 text-sm"
                            type="password"
                            name="password_confirmation" 
                            placeholder="••••••••"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs font-bold text-red-500 ml-1" />
        </div>

        <div class="pt-4 space-y-4">
            <button type="submit" class="w-full py-4 bg-[#1e3a8a] hover:bg-[#152e75] text-white rounded-2xl font-bold text-lg shadow-xl shadow-blue-900/20 transform transition-all hover:-translate-y-1 active:scale-95">
                {{ __('Créer mon compte') }}
            </button>

            <div class="text-center">
                <a class="text-xs font-bold text-slate-500 hover:text-primary transition-colors" href="{{ route('login') }}">
                    {{ __('Déjà inscrit ? Connectez-vous') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
