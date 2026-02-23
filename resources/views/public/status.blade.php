@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 px-4">
        <!-- Logo/Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-[#1e3a8a]">État de votre dossier</h1>
                <p class="text-gray-500 mt-2 font-medium">Numéro : #{{ $stagiaire->dossier_number }}</p>
            </div>
            <div>
                <a href="{{ route('public.track') }}" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                    Nouvelle recherche
                </a>
            </div>
        </div>

        <!-- Status Card -->
        <div class="bg-white overflow-hidden shadow-xl rounded-3xl border border-gray-100 mb-8">
            <div class="p-8 md:p-10">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</h2>
                        <p class="text-gray-500 font-medium">{{ $stagiaire->email }}</p>
                    </div>
                    
                    <div>
                        @if($stagiaire->status == 'pending')
                            <div class="px-6 py-3 bg-amber-50 rounded-2xl flex items-center border border-amber-100">
                                <span class="flex h-3 w-3 mr-3 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                                </span>
                                <span class="text-amber-800 font-extrabold text-sm uppercase tracking-wider">En cours d'examen</span>
                            </div>
                        @elseif($stagiaire->status == 'accepted')
                            <div class="px-6 py-3 bg-emerald-50 rounded-2xl flex items-center border border-emerald-100">
                                <svg class="w-6 h-6 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-emerald-800 font-extrabold text-sm uppercase tracking-wider">Demande Acceptée</span>
                            </div>
                        @elseif($stagiaire->status == 'rejected')
                            <div class="px-6 py-3 bg-rose-50 rounded-2xl flex items-center border border-rose-100">
                                <svg class="w-6 h-6 text-rose-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                <span class="text-rose-800 font-extrabold text-sm uppercase tracking-wider">Demande Refusée</span>
                            </div>
                        @endif
                    </div>
                </div>

                @if($stagiaire->status == 'rejected' && $stagiaire->refusal_reason)
                    <div class="mb-10 p-6 bg-rose-50 border-l-4 border-rose-500 rounded-r-2xl">
                        <h4 class="text-rose-700 font-bold mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Information de l'administration :
                        </h4>
                        <p class="text-rose-900 font-medium italic text-lg">"{{ $stagiaire->refusal_reason }}"</p>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <!-- Application INFO -->
                    <div class="space-y-6">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest pl-1">Données du dossier</h3>
                        <div class="grid grid-cols-2 gap-y-6 bg-gray-50 rounded-3xl p-6 border border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 font-semibold mb-1">Établissement</p>
                                <p class="text-gray-900 font-bold">{{ $stagiaire->universite }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-semibold mb-1">Filière</p>
                                <p class="text-gray-900 font-bold">{{ $stagiaire->filiere }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-semibold mb-1">Date Début</p>
                                <p class="text-gray-900 font-bold">{{ \Carbon\Carbon::parse($stagiaire->debut_stage)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-semibold mb-1">Date Fin</p>
                                <p class="text-gray-900 font-bold">{{ \Carbon\Carbon::parse($stagiaire->fin_stage)->format('d/m/Y') }}</p>
                            </div>
                            @if($stagiaire->message)
                                <div class="col-span-2 pt-2 border-t border-gray-100 mt-2">
                                    <p class="text-xs text-gray-400 font-semibold mb-1">Message / Motivations</p>
                                    <p class="text-gray-700 text-sm italic font-medium">"{{ $stagiaire->message }}"</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col justify-end">
                        @if($stagiaire->status == 'accepted')
                            <div class="bg-blue-600 rounded-3xl p-8 text-white shadow-xl shadow-blue-200">
                                <h3 class="text-xl font-bold mb-3">Attestation disponible</h3>
                                <p class="text-blue-100 text-sm mb-8 leading-relaxed">Votre attestation de stage a été générée. Vous pouvez la télécharger ci-dessous.</p>
                                
                                <a href="{{ route('public.download-certificate', [$stagiaire->id, $stagiaire->dossier_number]) }}" class="flex items-center justify-center w-full py-4 px-6 bg-white text-blue-700 font-black rounded-2xl hover:bg-blue-50 transition-all shadow-lg active:scale-95">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Télécharger l'Attestation
                                </a>
                            </div>
                        @else
                            <div class="bg-white border-2 border-dashed border-gray-200 rounded-3xl p-8 text-center h-full flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-200 mb-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-gray-400 font-bold text-sm">Votre attestation sera disponible ici après validation de votre stage.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Check -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest p-6 bg-gray-50 border-b border-gray-100">Documents enregistrés</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-100">
                @foreach([
                    'CV' => $stagiaire->cv_path,
                    'Motivation' => $stagiaire->motivation_letter_path,
                    'Convention' => $stagiaire->signed_convention_path,
                ] as $label => $path)
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center mr-3 font-black text-xs">PDF</div>
                        <span class="font-bold text-gray-700">{{ $label }}</span>
                    </div>
                    @if($path)
                        <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    @else
                        <svg class="w-5 h-5 text-gray-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
