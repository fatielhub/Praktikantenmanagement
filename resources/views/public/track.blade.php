@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full px-6">
        <!-- Logo/Header -->
        <div class="text-center mb-10">
            <div class="inline-block w-20 h-20 bg-white rounded-2xl shadow-xl p-3 mb-6 overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/fr/b/bd/Logo_Universit%C3%A9_Mohammed_Ier.png" alt="Logo FSO" class="w-full h-full object-contain">
            </div>
            <h1 class="text-3xl font-extrabold text-[#1e3a8a]">Suivi de Dossier</h1>
            <p class="text-gray-600 mt-2 font-medium">Consultez l'état de votre demande de stage</p>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-start gap-3">
                <svg class="w-10 h-10 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm font-bold text-green-800 leading-tight">{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-2xl flex items-start gap-3">
                <svg class="w-10 h-10 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="text-sm font-bold text-red-800 leading-tight">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-2xl rounded-3xl border border-gray-100 p-8 md:p-10">
            <form action="{{ route('public.status') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 pl-1">Votre adresse email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Etudiant@example.com" class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium py-3 px-4 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 pl-1">Numéro de dossier</label>
                    <input type="text" name="dossier_number" value="{{ old('dossier_number') }}" placeholder="Ex: ST-2024-XXXX" class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium py-3 px-4 shadow-sm" required>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#1e3a8a] hover:bg-[#152e75] text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-blue-900/20 transition-all transform hover:-translate-y-0.5 active:scale-95 text-center">
                        Vérifier mon statut
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-gray-500 text-sm font-medium">Vous n'avez pas encore postulé ?</p>
                <a href="{{ route('public.apply') }}" class="text-[#1e3a8a] font-bold text-sm hover:underline mt-1 inline-block">Déposer une candidature</a>
            </div>
        </div>
        
        <div class="text-center mt-10 text-gray-400 text-xs font-semibold uppercase tracking-widest">
            Faculté des Sciences Oujda
        </div>
    </div>
</div>
@endsection
