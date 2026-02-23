@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Logo/Header -->
        <div class="text-center mb-10">
            <div class="inline-block w-20 h-20 bg-white rounded-2xl shadow-xl p-3 mb-6 overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/fr/b/bd/Logo_Universit%C3%A9_Mohammed_Ier.png" alt="Logo FSO" class="w-full h-full object-contain">
            </div>
            <h1 class="text-3xl font-extrabold text-[#1e3a8a]">Faculté des Sciences d'Oujda</h1>
            <p class="text-gray-600 mt-2 font-medium">Service Informatique - Portail des Stagiaires</p>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
            <div class="p-8 md:p-12">
                <header class="mb-10 flex items-center justify-between border-b border-gray-100 pb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Candidature au Stage</h2>
                        <p class="text-gray-500 text-sm mt-1">Veuillez remplir le formulaire pour soumettre votre dossier.</p>
                    </div>
                    <div class="hidden sm:block">
                        <a href="{{ route('public.track') }}" class="text-blue-600 hover:text-blue-800 font-bold text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Suivre mon dossier
                        </a>
                    </div>
                </header>

                <form action="{{ route('public.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- 1. Informations Personnelles -->
                    <section>
                        <h3 class="text-lg font-bold text-[#1e3a8a] mb-6 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-blue-100 text-[#1e3a8a] flex items-center justify-center mr-3 text-sm">1</span>
                            Informations Personnelles
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nom</label>
                                <input type="text" name="nom" value="{{ old('nom') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                                @error('nom') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Prénom</label>
                                <input type="text" name="prenom" value="{{ old('prenom') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                                @error('prenom') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Email (Important pour le suivi)</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                                @error('email') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Téléphone</label>
                                <input type="text" name="telephone" value="{{ old('telephone') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                                @error('telephone') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">CNI (Carte Nationale)</label>
                                <input type="text" name="cin" value="{{ old('cin') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                                @error('cin') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Niveau d'études</label>
                                <select name="niveau_etude" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                                    <option value="">Sélectionnez votre niveau</option>
                                    <option value="Licence">Licence</option>
                                    <option value="Master">Master</option>
                                    <option value="Ingénieur">Cycle d'Ingénieur</option>
                                    <option value="Technicien">Technicien / Spécialisé</option>
                                </select>
                            </div>
                        </div>
                    </section>

                    <!-- 2. Détails du Stage -->
                    <section>
                        <h3 class="text-lg font-bold text-[#1e3a8a] mb-6 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-blue-100 text-[#1e3a8a] flex items-center justify-center mr-3 text-sm">2</span>
                            Détails de la demande
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Université / École</label>
                                <input type="text" name="universite" value="{{ old('universite') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Filière / Spécialité</label>
                                <input type="text" name="filiere" value="{{ old('filiere') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Date de début souhaitée</label>
                                <input type="date" name="debut_stage" value="{{ old('debut_stage') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Date de fin souhaitée</label>
                                <input type="date" name="fin_stage" value="{{ old('fin_stage') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-1">Message / Motivations</label>
                                <textarea name="message" rows="3" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium">{{ old('message') }}</textarea>
                            </div>
                        </div>
                    </section>

                    <!-- 3. Documents -->
                    <section>
                        <h3 class="text-lg font-bold text-[#1e3a8a] mb-6 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-blue-100 text-[#1e3a8a] flex items-center justify-center mr-3 text-sm">3</span>
                            Documents requis (PDF uniquement)
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            @foreach([
                                'cv' => 'Curriculum Vitae (CV)',
                                'motivation_letter' => 'Lettre de Motivation',
                                'cni_copy' => 'Copie de la CNI',
                                'insurance_certificate' => "Attestation d'Assurance",
                                'signed_convention' => 'Convention de Stage'
                            ] as $key => $label)
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">{{ $label }}</label>
                                <div class="relative">
                                    <input type="file" name="{{ $key }}" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all border border-dashed border-gray-300 rounded-xl p-1" required>
                                </div>
                                @error($key) <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                            @endforeach
                        </div>
                    </section>

                    <div class="pt-10 flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="flex-1 bg-[#1e3a8a] hover:bg-[#152e75] text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-blue-900/20 transition-all transform hover:-translate-y-0.5 active:scale-95 text-center">
                            Soumettre ma candidature
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="text-center mt-12 text-gray-500 text-sm font-medium">
            &copy; {{ date('Y') }} Service Informatique - Faculté des Sciences Oujda.
        </div>
    </div>
</div>
@endsection
