@extends('layouts.app')

@section('content')

<!-- Main Container for Layout -->
<div class="flex h-screen bg-gray-50 font-sans">
    
    <!-- Sidebar / Navigation -->
    <aside class="w-64 bg-[#1e3a8a] text-white flex flex-col shadow-xl z-20 sticky top-0 h-screen transition-all duration-300 hidden md:flex">
        <!-- Sidebar Brand -->
        <div class="h-20 flex items-center justify-center border-b border-blue-800/50 bg-[#162d6b]">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 w-full px-6">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-inner overflow-hidden p-1.5">
                    <img src="https://upload.wikimedia.org/wikipedia/fr/b/bd/Logo_Universit%C3%A9_Mohammed_Ier.png" alt="Logo UMP" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-white font-black text-lg tracking-tight leading-none">FS Oujda</h1>
                    <span class="text-blue-300 text-[10px] uppercase font-bold tracking-widest">Admin Panel</span>
                </div>
            </a>
        </div>

        <!-- Sidebar Links -->
        <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto w-full custom-scrollbar">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white font-medium transition-colors w-full group">
                <i class="fa-solid fa-chart-pie w-5 text-center text-blue-300/70 group-hover:text-white transition-colors"></i> 
                Tableau de Bord
            </a>

            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold text-blue-300/70 uppercase tracking-widest">Gestion</p>
            </div>

            <!-- Stagiaires (Active) -->
            <a href="{{ url('/stagiaires') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/10 text-white font-semibold transition-colors border border-white/10 shadow-sm w-full group">
                <i class="fa-solid fa-users w-5 text-center text-blue-200 group-hover:text-white transition-colors"></i> 
                Liste Stagiaires
            </a>
            
            <!-- Ajouter Stagiaire -->
            <a href="{{ url('/stagiaires/create') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white font-medium transition-colors w-full group">
                <i class="fa-solid fa-user-plus w-5 text-center text-blue-300/70 group-hover:text-white transition-colors"></i> 
                Ajouter Stagiaire
            </a>

            <!-- Attestations -->
            <a href="{{ url('/attestations') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white font-medium transition-colors w-full group">
                <i class="fa-solid fa-file-contract w-5 text-center text-blue-300/70 group-hover:text-white transition-colors"></i> 
                Attestations
            </a>

            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold text-blue-300/70 uppercase tracking-widest">Paramètres</p>
            </div>

            <!-- Mon Profil -->
            <a href="{{ url('/profile') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white font-medium transition-colors w-full group">
                <i class="fa-solid fa-user-gear w-5 text-center text-blue-300/70 group-hover:text-white transition-colors"></i> 
                Mon Profil
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-blue-800/50 bg-[#162d6b]">
            <form method="POST" action="{{ route('logout') }}" class="w-full m-0 p-0">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-200 hover:bg-red-500 hover:text-white font-semibold transition-all w-full group border border-transparent hover:border-red-400">
                    <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center group-hover:translate-x-1 transition-transform"></i> 
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <!-- Top Header for Main Area -->
        <header class="h-20 bg-white shadow-sm border-b border-gray-100 flex items-center justify-between px-8 shrink-0 z-10 sticky top-0">
            <div class="flex items-center gap-4">
                <a href="{{ route('stagiaires.index') }}" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition-colors border border-gray-200 shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-extrabold text-[#1e3a8a] tracking-tight">Profil Stagiaire</h2>
                    <p class="text-sm text-gray-500 font-medium mt-0.5">Détails et gestion experte du candidat</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="h-10 w-10 rounded-full bg-blue-100 border-2 border-white shadow-sm flex items-center justify-center text-[#1e3a8a] font-bold">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </header>

        <!-- Scrollable Content Layout -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-6 md:p-8">
            <div class="max-w-5xl mx-auto space-y-6 pb-10">

                {{-- Status Alerts --}}
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-start gap-4 shadow-sm animate-fade-in">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-emerald-800">Succès</h3>
                            <p class="text-sm text-emerald-700 mt-0.5">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-4 shadow-sm animate-fade-in">
                        <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-red-800">Erreur</h3>
                            <p class="text-sm text-red-700 mt-0.5">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Profile Header Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
                    <div class="h-32 bg-gradient-to-r from-[#1e3a8a] to-[#2563eb]"></div>
                    <div class="px-8 pb-8 relative">
                        <div class="flex flex-col md:flex-row gap-6 items-start md:items-end -mt-12">
                            <div class="w-24 h-24 rounded-2xl bg-white p-2 shadow-md border border-gray-100 flex-shrink-0">
                                <div class="w-full h-full rounded-xl bg-blue-50 text-[#1e3a8a] flex items-center justify-center text-4xl font-extrabold border border-blue-100">
                                    {{ substr($stagiaire->prenom ?? 'S', 0, 1) }}{{ substr($stagiaire->nom ?? '', 0, 1) }}
                                </div>
                            </div>
                            
                            <div class="flex-1 pb-2">
                                <h1 class="text-3xl font-extrabold text-gray-900">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</h1>
                                <div class="flex flex-wrap items-center gap-4 mt-2">
                                    <span class="text-sm font-medium text-gray-500 flex items-center gap-1.5"><i class="fa-regular fa-id-card text-gray-400"></i> {{ $stagiaire->cin ?? 'Non renseigné' }}</span>
                                    <span class="text-gray-300 hidden sm:block">•</span>
                                    <span class="text-sm font-medium text-gray-500 flex items-center gap-1.5"><i class="fa-regular fa-envelope text-gray-400"></i> {{ $stagiaire->email ?? 'Non renseigné' }}</span>
                                </div>
                            </div>

                            <div class="pb-2">
                                @if($stagiaire->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-bold bg-amber-100 text-amber-800 border border-amber-200 shadow-sm">
                                        <i class="fa-solid fa-hourglass-half text-amber-500"></i> En attente
                                    </span>
                                @elseif($stagiaire->status === 'accepted')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-bold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                        <i class="fa-solid fa-check-circle text-green-500"></i> Accepté
                                    </span>
                                @elseif($stagiaire->status === 'rejected')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-bold bg-red-100 text-red-800 border border-red-200 shadow-sm">
                                        <i class="fa-solid fa-xmark-circle text-red-500"></i> Rejeté
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Left Column: Details -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 border-b border-gray-50 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-50 text-gray-600 flex items-center justify-center border border-gray-100 shadow-inner">
                                    <i class="fa-solid fa-address-card"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Informations Complètes</h3>
                            </div>
                            <div class="p-6">
                                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
                                    <div>
                                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Filière d'étude</dt>
                                        <dd class="text-sm font-semibold text-gray-900 bg-gray-50 px-3 py-2 rounded-lg border border-gray-100">{{ $stagiaire->filiere ?? 'Non renseignée' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Niveau d'étude</dt>
                                        <dd class="text-sm font-semibold text-gray-900 bg-gray-50 px-3 py-2 rounded-lg border border-gray-100">{{ $stagiaire->niveau_etude ?? 'Non renseigné' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Téléphone</dt>
                                        <dd class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                                            <i class="fa-solid fa-phone text-gray-400 text-xs"></i> {{ $stagiaire->telephone ?? 'Non renseigné' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Date de naissance</dt>
                                        <dd class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                                            <i class="fa-solid fa-cake-candles text-gray-400 text-xs"></i> 
                                            {{ $stagiaire->date_naissance ? \Carbon\Carbon::parse($stagiaire->date_naissance)->format('d/m/Y') : 'Non renseignée' }}
                                        </dd>
                                    </div>
                                    
                                    <div class="sm:col-span-2 pt-2 border-t border-gray-100">
                                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Période de stage assignée</dt>
                                        <div class="flex items-center gap-4">
                                            <div class="flex-1 bg-blue-50/50 p-4 rounded-xl border border-blue-100 relative overflow-hidden">
                                                <div class="absolute right-0 top-0 h-full w-2 bg-[#1e3a8a]"></div>
                                                <p class="text-xs text-blue-500 font-bold mb-1 uppercase">Date de début</p>
                                                <p class="text-lg font-black text-[#1e3a8a]">{{ $stagiaire->debut_stage ? \Carbon\Carbon::parse($stagiaire->debut_stage)->format('d/m/Y') : 'N/A' }}</p>
                                            </div>
                                            <div class="text-gray-300"><i class="fa-solid fa-arrow-right"></i></div>
                                            <div class="flex-1 bg-red-50/50 p-4 rounded-xl border border-red-100 relative overflow-hidden">
                                                <div class="absolute right-0 top-0 h-full w-2 bg-red-500"></div>
                                                <p class="text-xs text-red-500 font-bold mb-1 uppercase">Date de fin</p>
                                                <p class="text-lg font-black text-red-700">{{ $stagiaire->fin_stage ? \Carbon\Carbon::parse($stagiaire->fin_stage)->format('d/m/Y') : 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2 pt-2 border-t border-gray-100">
                                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Message de motivation (Candidature)</dt>
                                        <dd class="text-sm text-gray-700 italic leading-relaxed bg-blue-50/30 p-4 rounded-xl border border-blue-50 font-medium">
                                            {{ $stagiaire->message ?: 'Aucun message fourni.' }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-2 pt-2 border-t border-gray-100">
                                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Sujet du Rapport / Mission</dt>
                                        <dd class="text-sm text-gray-800 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100 font-medium">
                                            {{ $stagiaire->sujet_rapport ?: 'Aucun sujet de rapport renseigné.' }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Actions -->
                    <div class="space-y-6">
                        
                        <!-- Moderation Actions -->
                        @if(auth()->user() && auth()->user()->role === 'admin')
                            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                                <div class="p-5 border-b border-gray-50 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-100 shadow-inner">
                                        <i class="fa-solid fa-gavel text-sm"></i>
                                    </div>
                                    <h3 class="text-md font-bold text-gray-900">Modération</h3>
                                </div>
                                <div class="p-5 space-y-3">
                                    @if($stagiaire->status === 'pending')
                                        <form action="{{ route('stagiaires.accept', $stagiaire->id) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-md shadow-emerald-600/20 border border-emerald-700">
                                                <i class="fa-solid fa-user-check"></i> Accepter la candidature
                                            </button>
                                        </form>
                                        <form action="{{ route('stagiaires.reject', $stagiaire->id) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-xl transition-all border border-red-200">
                                                <i class="fa-solid fa-user-xmark"></i> Rejeter la candidature
                                            </button>
                                        </form>
                                    @else
                                        <!-- En attente Button -->
                                        <form action="{{ route('stagiaires.setPending', $stagiaire->id) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" title="Remettre le statut en attente" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-xl transition-all border border-amber-200">
                                                <i class="fa-solid fa-rotate-left"></i> Rétrograder (En attente)
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Administrative Actions -->
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-5 border-b border-gray-50 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gray-50 text-gray-600 flex items-center justify-center border border-gray-100 shadow-inner">
                                    <i class="fa-solid fa-screwdriver-wrench text-sm"></i>
                                </div>
                                <h3 class="text-md font-bold text-gray-900">Outils</h3>
                            </div>
                            <div class="p-5 flex flex-col gap-3">
                                <a href="{{ route('stagiaires.edit', $stagiaire->id) }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-white hover:bg-blue-50 text-[#1e3a8a] border border-gray-200 hover:border-blue-200 font-bold rounded-xl transition-all shadow-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Modifier le profil
                                </a>
                                
                                <form action="{{ route('stagiaires.destroy', $stagiaire->id) }}" method="POST" class="w-full" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce profil ? Toute donnée associée (compte, attestations) risque d\'être perdue.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-white hover:bg-red-50 text-red-600 border border-gray-200 hover:border-red-200 font-bold rounded-xl transition-all shadow-sm">
                                        <i class="fa-regular fa-trash-can"></i> Supprimer le profil
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<!-- Add FontAwesome to Layout if not present globally -->
<script src="https://kit.fontawesome.com/your-code-here.js" crossorigin="anonymous"></script>

@endsection