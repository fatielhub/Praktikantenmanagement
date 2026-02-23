<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Un code de vérification a été envoyé à votre adresse email. Veuillez l'entrer ci-dessous.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.verify-code.store') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $email ?? session('email'))" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Code -->
        <div class="mt-4">
            <x-input-label for="code" :value="__('Code de vérification (6 chiffres)')" />
            <x-text-input id="code" class="block mt-1 w-full text-center text-2xl tracking-widest" type="text" name="code" maxlength="6" pattern="[0-9]{6}" required autofocus />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Vérifier le code') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
