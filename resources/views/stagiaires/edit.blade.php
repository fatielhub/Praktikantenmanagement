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
                    <h2 class="text-2xl font-extrabold text-[#1e3a8a] tracking-tight">Mise à jour Stagiaire</h2>
                    <p class="text-sm text-gray-500 font-medium mt-0.5">Modifier les informations du candidat</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="h-10 w-10 rounded-full bg-blue-100 border-2 border-white shadow-sm flex items-center justify-center text-[#1e3a8a] font-bold">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
            </div>
        </header>

        <!-- Scrollable Content Layout -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-6 md:p-8">
            <div class="max-w-4xl mx-auto space-y-6 pb-10">
                
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm animate-fade-in">
                        <div class="flex items-start">
                            <i class="fa-solid fa-triangle-exclamation text-red-500 text-lg mr-3 mt-0.5"></i>
                            <div>
                                <h3 class="text-sm font-bold text-red-800">Oups ! Des erreurs sont survenues.</h3>
                                <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <i class="fa-solid fa-sliders text-blue-600"></i> Paramètres du profil
                        </h3>
                    </div>

                    <form action="{{ route('stagiaires.update', $stagiaire->id) }}" method="POST" class="p-6 sm:p-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                            
                            {{-- Section Identité --}}
                            <div class="md:col-span-2 pb-2 border-b border-gray-50">
                                <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest">Identité</h4>
                            </div>

                            <div>
                                <label for="nom" class="block text-sm font-bold text-gray-700 mb-1.5">Nom de famille <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" name="nom" id="nom" value="{{ old('nom', $stagiaire->nom) }}" required
                                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium">
                                </div>
                            </div>

                            <div>
                                <label for="prenom" class="block text-sm font-bold text-gray-700 mb-1.5">Prénom <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $stagiaire->prenom) }}" required
                                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-bold text-gray-700 mb-1.5">Adresse Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" name="email" id="email" value="{{ old('email', $stagiaire->email) }}"
                                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium">
                                </div>
                            </div>

                            <div>
                                <label for="cin" class="block text-sm font-bold text-gray-700 mb-1.5">N° CIN / Pièce d'identité</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-id-card text-gray-400"></i>
                                    </div>
                                    <input type="text" name="cin" id="cin" value="{{ old('cin', $stagiaire->cin) }}"
                                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium">
                                </div>
                            </div>

                            <div>
                                <label for="telephone" class="block text-sm font-bold text-gray-700 mb-1.5">Téléphone</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-phone text-gray-400"></i>
                                    </div>
                                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $stagiaire->telephone) }}"
                                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium" placeholder="Ex: 06 12 34 56 78">
                                </div>
                            </div>

                            <div>
                                <label for="date_naissance" class="block text-sm font-bold text-gray-700 mb-1.5">Date de Naissance <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-cake-candles text-gray-400"></i>
                                    </div>
                                    <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', \Carbon\Carbon::parse($stagiaire->date_naissance)->format('Y-m-d')) }}" required
                                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium">
                                </div>
                            </div>


                            {{-- Section Stage --}}
                            <div class="md:col-span-2 pb-2 mt-4 border-b border-gray-50">
                                <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest">Informations sur le Stage</h4>
                            </div>

                            <div>
                                <label for="niveau_etude" class="block text-sm font-bold text-gray-700 mb-1.5">Niveau d'étude <span class="text-red-500">*</span></label>
                                <input type="text" name="niveau_etude" id="niveau_etude" value="{{ old('niveau_etude', $stagiaire->niveau_etude) }}" required
                                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium" placeholder="Ex: Bac+2, Licence, Master...">
                            </div>

                            <div>
                                <label for="filiere" class="block text-sm font-bold text-gray-700 mb-1.5">Filière</label>
                                <input type="text" name="filiere" id="filiere" value="{{ old('filiere', $stagiaire->filiere) }}"
                                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium" placeholder="Ex: Génie Informatique, Biologie...">
                            </div>

                            <div class="md:col-span-2">
                                <label for="service_id" class="block text-sm font-bold text-gray-700 mb-1.5">Service d'affectation</label>
                                <div class="relative">
                                    <select name="service_id" id="service_id"
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium appearance-none select-arrow">
                                        <option value="">-- Aucun Service / Non affecté --</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ old('service_id', $stagiaire->service_id) == $service->id ? 'selected' : '' }}>
                                                {{ $service->nom_service ?? 'Service ID: '.$service->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div>
                                <label for="debut_stage" class="block text-sm font-bold text-gray-700 mb-1.5">Coup d'envoi du Stage <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="date" name="debut_stage" id="debut_stage" value="{{ old('debut_stage', \Carbon\Carbon::parse($stagiaire->debut_stage)->format('Y-m-d')) }}" required
                                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium">
                                </div>
                            </div>

                            <div>
                                <label for="fin_stage" class="block text-sm font-bold text-gray-700 mb-1.5">Date de Finalisation <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-calendar-check text-gray-400"></i>
                                    </div>
                                    <input type="date" name="fin_stage" id="fin_stage" value="{{ old('fin_stage', \Carbon\Carbon::parse($stagiaire->fin_stage)->format('Y-m-d')) }}" required
                                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium">
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="message" class="block text-sm font-bold text-gray-700 mb-1.5">Message de motivation (Candidature)</label>
                                <textarea name="message" id="message" rows="3"
                                          class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium" 
                                          placeholder="Motivations de l'étudiant...">{{ old('message', $stagiaire->message) }}</textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label for="sujet_rapport" class="block text-sm font-bold text-gray-700 mb-1.5">Sujet du Rapport / Thème du Stage</label>
                                <textarea name="sujet_rapport" id="sujet_rapport" rows="3"
                                          class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white focus:border-[#1e3a8a] transition-colors shadow-sm text-sm font-medium" 
                                          placeholder="Aperçu ou titre de la mission confiée...">{{ old('sujet_rapport', $stagiaire->sujet_rapport) }}</textarea>
                            </div>
                            
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col sm:flex-row gap-4 items-center justify-end">
                            <a href="{{ route('stagiaires.index') }}"
                               class="w-full sm:w-auto px-6 py-2.5 bg-white text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-all border border-gray-300 shadow-sm text-center">
                                Annuler
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto px-8 py-2.5 bg-[#1e3a8a] hover:bg-[#152e75] text-white font-bold rounded-xl transition-all shadow-md hover:shadow-blue-900/30 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                Enregistrer les modifications
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
    /* Styling select to have custom beautiful arrow */
    .select-arrow {
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.25em;
    }

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