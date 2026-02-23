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
            
            <a href="{{ url('/stagiaires/create') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white font-medium transition-colors w-full group">
                <i class="fa-solid fa-user-plus w-5 text-center text-blue-300/70 group-hover:text-white transition-colors"></i> 
                Ajouter Stagiaire
            </a>

            <a href="{{ url('/attestations') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white font-medium transition-colors w-full group">
                <i class="fa-solid fa-file-contract w-5 text-center text-blue-300/70 group-hover:text-white transition-colors"></i> 
                Attestations
            </a>

            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold text-blue-300/70 uppercase tracking-widest">Paramètres</p>
            </div>

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
                <h2 class="text-2xl font-extrabold text-[#1e3a8a] tracking-tight">Liste des Stagiaires</h2>
                <p class="text-sm text-gray-500 font-medium mt-0.5">Gérez l'ensemble des étudiants stagiaires inscrits</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="h-10 w-10 rounded-full bg-blue-100 border-2 border-white shadow-sm flex items-center justify-center text-[#1e3a8a] cursor-pointer hover:ring-2 hover:ring-blue-400 transition-all">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </header>

        <!-- Scrollable Content Layout -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-8">
            <div class="max-w-7xl mx-auto space-y-6 pb-10">

                {{-- Alert Messages --}}
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm flex items-start gap-4 mb-6">
                        <i class="fa-solid fa-circle-check text-green-500 text-xl mt-0.5"></i>
                        <div>
                            <p class="text-sm font-bold text-green-800">Succès</p>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm flex items-start gap-4 mb-6">
                        <i class="fa-solid fa-circle-exclamation text-red-500 text-xl mt-0.5"></i>
                        <div>
                            <p class="text-sm font-bold text-red-800">Erreur</p>
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- KPI Quick Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Total Stagiaires</h3>
                            <div class="text-4xl font-extrabold text-[#1e3a8a]">{{ $stagiaires->total() ?? $stagiaires->count() }}</div>
                        </div>
                        <div class="w-16 h-16 bg-blue-50 text-[#1e3a8a] rounded-2xl flex items-center justify-center text-3xl border border-blue-100">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    
                    @php
                        // Check if we can approximate active/accepted via the collection
                        // If it's paginated, this count only applies to the current page unless calculated differently in controller
                        $activeCount = collect($stagiaires->items())->where('status', 'accepted')->count() ?? 0;
                    @endphp
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Stagiaires Actifs</h3>
                            <div class="text-4xl font-extrabold text-green-600">{{ $activeCount }}</div>
                        </div>
                        <div class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-3xl border border-green-100">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                    </div>
                </div>

                <!-- Table Card Container -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    
                    <!-- Search and Filter Tabs -->
                    <div class="border-b border-gray-100 bg-white">
                        
                        <!-- Status Tabs -->
                        <div class="px-6 pt-4 flex gap-6 overflow-x-auto custom-scrollbar">
                            <a href="{{ route('stagiaires.index', ['q' => request('q')]) }}" 
                               class="pb-3 text-sm font-semibold transition-colors border-b-2 whitespace-nowrap {{ !request('status') ? 'border-[#1e3a8a] text-[#1e3a8a]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Tous
                            </a>
                            <a href="{{ route('stagiaires.index', ['status' => 'pending', 'q' => request('q')]) }}" 
                               class="pb-3 text-sm font-semibold transition-colors border-b-2 whitespace-nowrap {{ request('status') === 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                En attente
                            </a>
                            <a href="{{ route('stagiaires.index', ['status' => 'accepted', 'q' => request('q')]) }}" 
                               class="pb-3 text-sm font-semibold transition-colors border-b-2 whitespace-nowrap {{ request('status') === 'accepted' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Acceptés
                            </a>
                            <a href="{{ route('stagiaires.index', ['status' => 'rejected', 'q' => request('q')]) }}" 
                               class="pb-3 text-sm font-semibold transition-colors border-b-2 whitespace-nowrap {{ request('status') === 'rejected' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Rejetés
                            </a>
                        </div>

                        <!-- Search and Add Buttons -->
                        <div class="px-6 py-4 flex flex-col sm:flex-row gap-4 justify-between items-center bg-gray-50/30">
                            
                            <form method="GET" action="{{ route('stagiaires.index') }}" class="relative w-full sm:flex-1 sm:max-w-md flex gap-2">
                                <!-- Maintain status parameter when searching -->
                                @if(request('status'))
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                @endif
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                                    </div>
                                    <input name="q" type="search" placeholder="Rechercher (Nom, Dossier, CIN...)" value="{{ request('q') }}"
                                           class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors shadow-sm rounded-xl">
                                </div>
                                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-200 px-4 py-2 rounded-xl text-sm font-semibold transition-colors shadow-sm flex items-center gap-2">
                                    Rechercher
                                </button>
                                @if(request('q'))
                                    <a href="{{ route('stagiaires.index', ['status' => request('status')]) }}" class="px-3 py-2 bg-red-50 hover:bg-red-100 text-red-500 rounded-xl border border-red-100 transition-colors flex items-center justify-center shadow-sm" title="Effacer la recherche">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                @endif
                            </form>

                            <a href="{{ route('stagiaires.create') }}" class="flex items-center gap-2 bg-[#1e3a8a] hover:bg-[#152e75] text-white px-5 py-2 rounded-xl font-semibold shadow-md shadow-blue-900/20 transition-all border border-blue-800 w-full sm:w-auto justify-center">
                                <i class="fa-solid fa-plus text-sm"></i> Ajouter
                            </a>
                        </div>
                    </div>

                    <!-- Responsive Data Table -->
                    <div class="overflow-x-auto w-full">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-bold border-b border-gray-200">
                                    <th class="px-6 py-4">ID</th>
                                    <th class="px-6 py-4">Étudiant</th>
                                    <th class="px-6 py-4">CIN</th>
                                    <th class="px-6 py-4">Filière</th>
                                    <th class="px-6 py-4 rounded-tl-lg">Statut</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                    <!-- Extra columns specifically for admin status manipulation -->
                                    <th class="px-6 py-4 text-center">Gestion de Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse($stagiaires as $stagiaire)
                                    <tr class="hover:bg-blue-50/50 transition-colors group">
                                        
                                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $stagiaire->dossier_number }}</td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-blue-100 text-[#1e3a8a] flex items-center justify-center font-bold text-xs">
                                                    {{ substr($stagiaire->prenom, 0, 1) }}{{ substr($stagiaire->nom, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</p>
                                                    <p class="text-xs text-gray-500">{{ $stagiaire->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 font-medium text-gray-600">{{ $stagiaire->cin }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $stagiaire->filiere }}</td>
                                        
                                        <td class="px-6 py-4">
                                            @if($stagiaire->status === 'pending')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> En attente
                                                </span>
                                            @elseif($stagiaire->status === 'accepted')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Accepté
                                                </span>
                                            @elseif($stagiaire->status === 'rejected')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Rejeté
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800 border border-gray-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> N/A
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <!-- General View/Edit/Delete Actions -->
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('stagiaires.show', $stagiaire->id) }}" title="Voir les détails"
                                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-[#1e3a8a] transition-colors">
                                                    <i class="fa-solid fa-eye text-xs"></i>
                                                </a>

                                                <a href="{{ route('stagiaires.edit', $stagiaire->id) }}" title="Modifier"
                                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-600 hover:bg-amber-100 hover:text-amber-700 transition-colors">
                                                    <i class="fa-solid fa-pen text-xs"></i>
                                                </a>

                                                <form action="{{ route('stagiaires.destroy', $stagiaire->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce stagiaire ? Cette action est irréversible.')" class="m-0 p-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Supprimer" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-700 transition-colors">
                                                        <i class="fa-solid fa-trash text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        
                                        <!-- Admin Status Actions Grid -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-1.5">
                                                @if(auth()->check() && auth()->user()->role === 'admin')
                                                    @if($stagiaire->status !== 'accepted')
                                                        <form action="{{ route('stagiaires.accept', $stagiaire->id) }}" method="POST" class="m-0 p-0">
                                                            @csrf
                                                            <button type="submit" title="Accepter la demande" class="p-1.5 bg-green-50 text-green-600 border border-green-200 rounded text-xs hover:bg-green-600 hover:text-white transition-colors">
                                                                <i class="fa-solid fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    @if($stagiaire->status !== 'rejected')
                                                        <button type="button" 
                                                                onclick="openRejectModal({{ $stagiaire->id }}, '{{ $stagiaire->prenom }} {{ $stagiaire->nom }}')"
                                                                title="Rejeter la demande" 
                                                                class="p-1.5 bg-red-50 text-red-600 border border-red-200 rounded text-xs hover:bg-red-600 hover:text-white transition-colors">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    @endif
                                                    
                                                    @if($stagiaire->status !== 'pending')
                                                        <form action="{{ route('stagiaires.setPending', $stagiaire->id) }}" method="POST" class="m-0 p-0">
                                                            @csrf
                                                            <button type="submit" title="Remettre en attente" class="p-1.5 bg-yellow-50 text-yellow-600 border border-yellow-200 rounded text-xs hover:bg-yellow-500 hover:text-white transition-colors">
                                                                <i class="fa-solid fa-clock-rotate-left"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <span class="text-xs text-gray-400 italic">Non autorisé</span>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-400">
                                                <i class="fa-regular fa-folder-open text-4xl mb-3"></i>
                                                <p class="text-base font-semibold text-gray-500">Aucun stagiaire trouvé</p>
                                                <p class="text-sm mt-1">Modifiez vos critères de recherche ou ajoutez un nouveau stagiaire.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($stagiaires->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                            {{ $stagiaires->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </main>
</div>

<!-- Reject Reason Modal -->
<div id="rejectModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeRejectModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="rejectForm" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">Rejeter la demande</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 mb-4" id="reject-message-info">
                                    Veuillez indiquer la raison du refus pour l'étudiant.
                                </p>
                                <textarea name="refusal_reason" id="refusal_reason" rows="4" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
                                    placeholder="Ex: Documents incomplets, Profil ne correspond pas, etc."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirmer le rejet
                    </button>
                    <button type="button" onclick="closeRejectModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openRejectModal(id, name) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        const info = document.getElementById('reject-message-info');
        
        info.innerText = `Veuillez indiquer la raison du refus pour ${name}.`;
        form.action = `/stagiaires/${id}/reject`;
        
        modal.classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }
</script>

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