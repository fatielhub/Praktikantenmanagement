<x-guest-layout>
    <div class="mb-6 text-sm text-slate-600 font-medium leading-relaxed text-center">
        <i class="fa-solid fa-circle-info text-primary mb-2 text-xl block"></i>
        Mot de passe oublié ? Entrez votre adresse email et nous vous enverrons un lien de réinitialisation.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-bold text-slate-700 ml-1">
                <i class="fa-solid fa-envelope mr-1 opacity-50"></i> {{ __('Email') }}
            </label>
            <input id="email" class="block w-full px-4 py-3.5 bg-white/50 border border-slate-200 rounded-2xl text-slate-900 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none font-medium placeholder:text-slate-400" type="email" name="email" :value="old('email')" placeholder="votre.email@ump.ac.ma" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs font-bold text-red-500 ml-1" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-4 bg-[#1e3a8a] hover:bg-[#152e75] text-white rounded-2xl font-bold text-lg shadow-xl shadow-blue-900/20 transform transition-all hover:-translate-y-1 active:scale-95">
                {{ __('Envoyer le lien') }}
            </button>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-xs font-bold text-slate-500 hover:text-primary transition-colors">
                <i class="fa-solid fa-arrow-left mr-1"></i> Retour à la connexion
            </a>
        </div>
    </form>
</x-guest-layout>
