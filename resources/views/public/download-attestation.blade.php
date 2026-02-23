@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full mx-auto sm:px-6 lg:px-8 px-4">
        
        <!-- Premium Download Card -->
        <div class="bg-white overflow-hidden shadow-2xl rounded-[2.5rem] border border-gray-100 relative">
            <!-- Decorative background elements -->
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>

            <div class="p-8 md:p-12 relative">
                <!-- University Branding -->
                <div class="flex flex-col items-center text-center mb-10">
                    <div class="w-20 h-20 bg-[#1e3a8a] rounded-2xl flex items-center justify-center text-white mb-4 shadow-lg shadow-blue-900/20 transform -rotate-3 hover:rotate-0 transition-transform duration-500">
                        <i class="fa-solid fa-graduation-cap text-3xl"></i>
                    </div>
                    <h1 class="text-2xl font-black text-[#1e3a8a] tracking-tight">Faculté des Sciences d'Oujda</h1>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-[0.2em] mt-1">Attestation Officielle de Stage</p>
                </div>

                <!-- Success Indicator -->
                <div class="mb-10 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full mb-4 animate-bounce-slow">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 mb-2">Votre document est prêt !</h2>
                    <p class="text-gray-500 font-medium">Félicitations pour la réussite de votre stage au sein de notre établissement.</p>
                </div>

                <!-- Document Details -->
                <div class="bg-gray-50 rounded-3xl p-6 mb-10 border border-gray-100">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200/60">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Stagiaire</span>
                            <span class="font-bold text-gray-800">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200/60">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">N° Dossier</span>
                            <span class="text-blue-600 font-black">#{{ $stagiaire->dossier_number }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Période</span>
                            <span class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($stagiaire->debut_stage)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($stagiaire->fin_stage)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Primary Action -->
                <div class="space-y-4">
                    <a href="{{ route('public.download-certificate.file', [$stagiaire->id, $stagiaire->dossier_number]) }}" 
                       class="flex items-center justify-center w-full py-5 px-8 bg-[#1e3a8a] text-white font-black rounded-2xl hover:bg-[#162d6b] transition-all shadow-xl shadow-blue-900/30 transform hover:-translate-y-1 active:scale-95 group">
                        <svg class="w-6 h-6 mr-3 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Télécharger le document PDF
                    </a>
                    
                    <a href="{{ route('public.track') }}" class="flex items-center justify-center w-full py-4 text-sm font-bold text-gray-400 hover:text-[#1e3a8a] transition-colors">
                        <i class="fa-solid fa-arrow-left-long mr-2"></i> Retour au suivi
                    </a>
                </div>
            </div>

            <!-- Footer info -->
            <div class="bg-gray-50/50 p-6 text-center border-t border-gray-50">
                <p class="text-xs text-gray-400 font-medium">Ce document est muni d'une signature électronique et son authenticité peut être vérifiée auprès du service informatique.</p>
            </div>
        </div>

        <!-- Support Info -->
        <div class="text-center mt-10">
            <p class="text-gray-400 text-sm font-medium italic">Un problème de téléchargement ? <a href="#" class="text-blue-500 underline">Contactez support-fso@ump.ac.ma</a></p>
        </div>
    </div>
</div>

<style>
    @keyframes bounceSlow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    .animate-bounce-slow {
        animation: bounceSlow 3s infinite ease-in-out;
    }
</style>
@endsection