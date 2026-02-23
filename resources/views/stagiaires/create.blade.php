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
            
            <!-- Ajouter Stagiaire (Active) -->
            <a href="{{ url('/stagiaires/create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/10 text-white font-semibold transition-colors border border-white/10 shadow-sm w-full group">
                <i class="fa-solid fa-user-plus w-5 text-center text-blue-200 group-hover:text-white transition-colors"></i> 
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
            <div>
                <h2 class="text-2xl font-extrabold text-[#1e3a8a] tracking-tight">Ajouter un Stagiaire</h2>
                <p class="text-sm text-gray-500 font-medium mt-0.5">Veuillez remplir le formulaire pour inscrire un nouveau stagiaire</p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ url('/stagiaires') }}" class="hidden sm:flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-semibold shadow-sm transition-all border border-gray-200">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                    Retour à la liste
                </a>
            </div>
        </header>

        <!-- Scrollable Content Layout -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-8">
            <div class="max-w-4xl mx-auto pb-10">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    
                    <div class="p-8 border-b border-gray-100 bg-white">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#1e3a8a] flex items-center justify-center text-xl shadow-sm border border-blue-100">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Formulaire d'inscription</h3>
                                <p class="text-sm text-gray-500 mt-1">Saisissez les informations du stagiaire et de son projet</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('stagiaires.store') }}" method="POST" class="p-8 space-y-8 bg-white">
                        @csrf

                        {{-- Global Errors --}}
                        @if ($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm flex items-start gap-4">
                                <i class="fa-solid fa-circle-exclamation text-red-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-bold text-red-800">Veuillez corriger les erreurs suivantes :</p>
                                    <ul class="list-disc list-inside text-sm text-red-700 mt-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        {{-- Informations personnelles --}}
                        <div class="space-y-6">
                            <h4 class="text-sm font-bold text-[#1e3a8a] uppercase tracking-wider border-b border-gray-100 pb-2">Informations personnelles</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nom --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nom <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-regular fa-user text-gray-400"></i>
                                        </div>
                                        <input type="text" name="nom" value="{{ old('nom') }}" required 
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('nom') border-red-500 ring-red-500 @enderror"
                                               placeholder="Ex: El Amrani">
                                    </div>
                                    @error('nom') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>

                                {{-- Prénom --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Prénom <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-regular fa-user text-gray-400"></i>
                                        </div>
                                        <input type="text" name="prenom" value="{{ old('prenom') }}" required 
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('prenom') border-red-500 @enderror"
                                               placeholder="Ex: Youssef">
                                    </div>
                                    @error('prenom') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-regular fa-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email') }}" 
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('email') border-red-500 @enderror"
                                               placeholder="youssef@example.com">
                                    </div>
                                    @error('email') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>

                                {{-- CIN --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">CIN</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-regular fa-id-card text-gray-400"></i>
                                        </div>
                                        <input type="text" name="cin" value="{{ old('cin') }}" 
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('cin') border-red-500 @enderror"
                                               placeholder="Ex: F123456">
                                    </div>
                                    @error('cin') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>

                                {{-- Date de naissance --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Date de naissance <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-regular fa-calendar text-gray-400"></i>
                                        </div>
                                        <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" required 
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('date_naissance') border-red-500 @enderror">
                                    </div>
                                    @error('date_naissance') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>

                                {{-- Téléphone --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Téléphone</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-phone text-gray-400"></i>
                                        </div>
                                        <input type="number" name="telephone" value="{{ old('telephone') }}" 
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('telephone') border-red-500 @enderror"
                                               placeholder="Ex: 0600000000">
                                    </div>
                                    @error('telephone') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Projet --}}
                        <div class="space-y-6 pt-4">
                            <h4 class="text-sm font-bold text-[#1e3a8a] uppercase tracking-wider border-b border-gray-100 pb-2">Détails du projet</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Titre du projet</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-heading text-gray-400"></i>
                                        </div>
                                        <input type="text" name="project_title" value="{{ old('project_title') }}"
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('project_title') border-red-500 @enderror"
                                               placeholder="Saisissez le titre du projet...">
                                    </div>
                                    @error('project_title') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description du projet</label>
                                    <div class="relative">
                                        <div class="absolute top-3.5 left-3 flex items-start pointer-events-none">
                                            <i class="fa-solid fa-align-left text-gray-400"></i>
                                        </div>
                                        <textarea name="project_description" rows="3" 
                                                  class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('project_description') border-red-500 @enderror"
                                                  placeholder="Décrivez brièvement le projet...">{{ old('project_description') }}</textarea>
                                    </div>
                                    @error('project_description') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Message de motivation / Candidature</label>
                                    <div class="relative">
                                        <div class="absolute top-3.5 left-3 flex items-start pointer-events-none">
                                            <i class="fa-solid fa-comment-dots text-gray-400"></i>
                                        </div>
                                        <textarea name="message" rows="3" 
                                                  class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('message') border-red-500 @enderror"
                                                  placeholder="Saisissez les motivations de l'étudiant...">{{ old('message') }}</textarea>
                                    </div>
                                    @error('message') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Informations de stage --}}
                        <div class="space-y-6 pt-4">
                            <h4 class="text-sm font-bold text-[#1e3a8a] uppercase tracking-wider border-b border-gray-100 pb-2">Informations de stage</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Début de Stage --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Début de Stage <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-play text-gray-400"></i>
                                        </div>
                                        <input type="date" name="debut_stage" value="{{ old('debut_stage') }}" required
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('debut_stage') border-red-500 @enderror">
                                    </div>
                                    @error('debut_stage') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>

                                {{-- Fin de Stage --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Fin de Stage <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-stop text-gray-400"></i>
                                        </div>
                                        <input type="date" name="fin_stage" value="{{ old('fin_stage') }}" required
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('fin_stage') border-red-500 @enderror">
                                    </div>
                                    @error('fin_stage') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>
                                
                                {{-- Niveau d'étude --}}
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Niveau d'étude <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-graduation-cap text-gray-400"></i>
                                        </div>
                                        <input type="text" name="niveau_etude" value="{{ old('niveau_etude') }}" required
                                               class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('niveau_etude') border-red-500 @enderror"
                                               placeholder="Ex: Bac+3, Master 2, DUT...">
                                    </div>
                                    @error('niveau_etude') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>

                                {{-- Sujet du rapport --}}
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Sujet du rapport</label>
                                    <div class="relative">
                                        <div class="absolute top-3.5 left-3 flex items-start pointer-events-none">
                                            <i class="fa-solid fa-book-open text-gray-400"></i>
                                        </div>
                                        <textarea name="sujet_rapport" rows="3" 
                                                  class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('sujet_rapport') border-red-500 @enderror"
                                                  placeholder="Décrivez le sujet du rapport assigné (le cas échéant)...">{{ old('sujet_rapport') }}</textarea>
                                    </div>
                                    @error('sujet_rapport') <p class="text-red-500 text-xs mt-1.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>
                                
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t border-gray-100">
                            <a href="{{ route('stagiaires.index') }}" 
                               class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm">
                                Annuler
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2.5 rounded-xl bg-[#1e3a8a] text-white font-semibold hover:bg-[#152e75] transition-all shadow-md shadow-blue-900/20 border border-blue-800 flex items-center gap-2">
                                <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </main>
</div>

<!-- Add FontAwesome to Layout if not present globally -->
<script src="https://kit.fontawesome.com/your-code-here.js" crossorigin="anonymous"></script>

<style>
    /* Custom Scrollbar for sidebar and main content */
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