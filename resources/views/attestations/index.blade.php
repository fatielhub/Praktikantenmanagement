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

            <!-- Stagiaires -->
            <a href="{{ url('/stagiaires') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white font-medium transition-colors w-full group">
                <i class="fa-solid fa-users w-5 text-center text-blue-300/70 group-hover:text-white transition-colors"></i> 
                Liste Stagiaires
            </a>
            
            <!-- Ajouter Stagiaire -->
            <a href="{{ url('/stagiaires/create') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white font-medium transition-colors w-full group">
                <i class="fa-solid fa-user-plus w-5 text-center text-blue-300/70 group-hover:text-white transition-colors"></i> 
                Ajouter Stagiaire
            </a>

            <!-- Attestations (Active) -->
            <a href="{{ url('/attestations') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/10 text-white font-semibold transition-colors border border-white/10 shadow-sm w-full group">
                <i class="fa-solid fa-file-contract w-5 text-center text-blue-200 group-hover:text-white transition-colors"></i> 
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
        
        <!-- Top Header -->
        <header class="h-20 bg-white shadow-sm border-b border-gray-100 flex items-center justify-between px-8 shrink-0 z-10 sticky top-0">
            <div>
                <h2 class="text-2xl font-extrabold text-[#1e3a8a] tracking-tight">Attestations de Stage</h2>
                <p class="text-sm text-gray-500 font-medium mt-0.5">Gérez la délivrance des certificats</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="h-10 w-10 rounded-full bg-blue-100 border-2 border-white shadow-sm flex items-center justify-center text-[#1e3a8a] font-bold">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-6 md:p-8">
            <div class="max-w-7xl mx-auto space-y-8 pb-10">

                {{-- Messages / Alertes --}}
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
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-red-800">Erreur lors de l'opération</h3>
                            <p class="text-sm text-red-700 mt-0.5">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                {{-- Bloc de Génération d'Attestation --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative">
                    <!-- Deco element -->
                    <div class="absolute right-0 top-0 w-64 h-full bg-gradient-to-l from-blue-50/50 to-transparent pointer-events-none hidden md:block"></div>
                    
                    <div class="p-6 border-b border-gray-100 bg-white relative z-10 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#1e3a8a] flex items-center justify-center text-xl border border-blue-100 shadow-inner">
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Générer une attestation</h3>
                            <p class="text-sm text-gray-500 mt-1">Sélectionnez un stagiaire parmi la liste des profils acceptés.</p>
                        </div>
                    </div>
                    
                    <div class="p-6 bg-gray-50/30 relative z-10">
                        @if($acceptedStagiaires->isEmpty())
                            <div class="bg-amber-50 border border-amber-200 p-5 rounded-xl flex items-center gap-4 shadow-sm">
                                <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-lg shrink-0">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-amber-800">Aucun stagiaire accepté</h4>
                                    <p class="text-sm text-amber-700 mt-0.5">Acceptez d'abord un stagiaire depuis la liste des étudiants en attente d'approbation.</p>
                                </div>
                            </div>
                        @else
                            <form action="{{ route('attestations.generate') }}" method="POST" class="w-full">
                                @csrf
                                <div class="flex flex-col lg:flex-row lg:items-end gap-6">
                                    <div class="flex-1 w-full">
                                        <label for="stagiaire_id" class="block text-sm font-bold text-gray-700 mb-2">
                                            Sélectionner un étudiant <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i class="fa-solid fa-user-graduate text-gray-400"></i>
                                            </div>
                                            <select name="stagiaire_id" id="stagiaire_id" required
                                                    class="w-full pl-11 pr-10 py-3 bg-white border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:border-[#1e3a8a] transition-all shadow-sm text-sm appearance-none outline-none cursor-pointer font-medium hover:border-gray-300">
                                                <option value="">— Veuillez sélectionner un stagiaire —</option>
                                                @foreach($acceptedStagiaires as $s)
                                                    <option value="{{ $s->id }}" {{ old('stagiaire_id') == $s->id ? 'selected' : '' }}>
                                                        {{ $s->prenom }} {{ $s->nom }} - {{ $s->email ?? 'Sans adresse email' }} ({{ $s->cin ?? 'Aucun CIN' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('stagiaire_id')
                                            <p class="text-red-500 text-xs mt-2 font-semibold"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" 
                                            class="w-full lg:w-auto px-8 py-3 bg-[#1e3a8a] hover:bg-[#152e75] text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-blue-900/30 flex items-center justify-center gap-2 transform active:scale-95">
                                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                                        Générer l'attestation PDF
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- Tableau de l'Historique --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center text-lg shadow-inner border border-gray-200">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Archives des Attestations</h3>
                                <p class="text-sm text-gray-500 mt-1">Consultez les documents précédemment émis</p>
                            </div>
                        </div>
                        <span class="px-3 py-1.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-lg border border-gray-200">
                            {{ $attestations->total() }} Fichier(s)
                        </span>
                    </div>

                    <div class="overflow-x-auto w-full">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead>
                                <tr class="bg-gray-50/80 text-gray-500 text-xs uppercase tracking-wider font-extrabold border-b border-gray-200">
                                    <th class="px-6 py-4">Réf.</th>
                                    <th class="px-6 py-4">Identité du Stagiaire</th>
                                    <th class="px-6 py-4">Période Validée</th>
                                    <th class="px-6 py-4">Date de Création</th>
                                    <th class="px-6 py-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse($attestations as $att)
                                    <tr class="hover:bg-blue-50/40 transition-colors">
                                        
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200 tracking-widest shadow-sm">
                                                #{{ $att->numero_attestation }}
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">{{ $att->stagiaire->prenom }} {{ $att->stagiaire->nom }}</div>
                                            <div class="text-gray-500 text-[11px] mt-0.5 uppercase tracking-wide">{{ $att->stagiaire->cin }}</div>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-gray-600 font-medium">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-regular fa-calendar-check text-green-500"></i>
                                                {{ $att->date_debut->format('d/m/Y') }} — {{ $att->date_fin->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-gray-600 font-medium">
                                            {{ $att->created_at->format('d/m/Y') }} <span class="text-xs text-gray-400 ml-1">{{ $att->created_at->format('H:i') }}</span>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('attestations.view', $att->id) }}" target="_blank" title="Visionner le document"
                                                   class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white border border-gray-200 text-gray-700 hover:text-blue-600 hover:border-blue-300 hover:bg-blue-50 transition-all shadow-sm">
                                                    <i class="fa-solid fa-eye text-sm"></i>
                                                </a>
                                                <a href="{{ route('attestations.download', $att->id) }}" title="Télécharger le PDF"
                                                   class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#1e3a8a] text-white hover:bg-[#152e75] transition-all shadow-sm">
                                                    <i class="fa-solid fa-download text-sm"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-400">
                                                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4 text-2xl text-gray-300">
                                                    <i class="fa-solid fa-box-archive"></i>
                                                </div>
                                                <p class="text-base font-bold text-gray-600">Aucune archive disponible</p>
                                                <p class="text-sm mt-1 max-w-sm text-gray-500">Il n'y a pas encore d'attestations générées dans la base de données.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($attestations->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                            {{ $attestations->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </main>
</div>

<!-- Ensure FontAwesome is included for Icons -->
<script src="https://kit.fontawesome.com/your-code-here.js" crossorigin="anonymous"></script>

<style>
    /* Styling select to have custom beautiful arrow */
    select {
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1.25rem center;
        background-size: 1.25em;
    }

    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.3); }
    
    main::-webkit-scrollbar { width: 8px; }
    main::-webkit-scrollbar-track { background: #f8fafc; }
    main::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; border: 2px solid #f8fafc; }
    main::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    
</style>

@endsection