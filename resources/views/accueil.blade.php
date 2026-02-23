<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stagiaires | Faculté des Sciences Oujda</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Assets (Tailwind & AOS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .mesh-gradient {
            background-color: #1e3a8a;
            background-image: 
                radial-gradient(at 0% 0%, hsla(224, 64%, 33%, 1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(217, 91%, 60%, 1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(201, 96%, 32%, 1) 0, transparent 50%);
        }

        .hero-shape {
            position: absolute;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.4;
        }

        .orbit-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .floating-icon {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-[100] transition-all duration-500 glass-card" id="main-nav" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg shadow-blue-900/10 group overflow-hidden p-1">
                    <img src="https://upload.wikimedia.org/wikipedia/fr/b/bd/Logo_Universit%C3%A9_Mohammed_Ier.png" alt="Logo FSO" class="w-full h-full object-contain group-hover:scale-110 transition-transform">
                </div>
                <div>
                    <span class="block text-xl font-extrabold text-[#111827] tracking-tight leading-none">FS Oujda</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1 block">Gestion Stagiaires</span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-8">
                <a href="#hero" class="text-sm font-bold text-[#1e3a8a] border-b-2 border-primary pb-1">Accueil</a>
                <a href="#features" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">Fonctionnalités</a>
                <a href="#stats" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">Impact</a>
                <a href="{{ route('public.track') }}" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">Suivi</a>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-bold hover:bg-black transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-primary">Se connecter</a>
                        <a href="{{ route('public.apply') }}" class="px-5 py-2.5 bg-[#1e3a8a] text-white rounded-xl text-sm font-bold hover:bg-blue-800 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Postuler
                        </a>
                    @endauth
                </div>
                
                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-slate-600 hover:text-primary transition-colors">
                    <i class="fa-solid fa-bars-staggered text-2xl" x-show="!mobileMenuOpen"></i>
                    <i class="fa-solid fa-xmark text-2xl" x-show="mobileMenuOpen" style="display: none;"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 -translate-y-4" 
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden bg-white border-t border-slate-100 p-6 space-y-4 shadow-xl">
            <a href="#hero" @click="mobileMenuOpen = false" class="block text-lg font-bold text-slate-800">Accueil</a>
            <a href="#features" @click="mobileMenuOpen = false" class="block text-lg font-bold text-slate-800">Fonctionnalités</a>
            <a href="#stats" @click="mobileMenuOpen = false" class="block text-lg font-bold text-slate-800">Impact</a>
            <a href="{{ route('public.track') }}" class="block text-lg font-bold text-slate-800">Suivi Dossier</a>
            <hr class="border-slate-100">
            @auth
                <a href="{{ route('dashboard') }}" class="block w-full py-4 bg-slate-900 text-white text-center rounded-2xl font-bold">Accéder au Dashboard</a>
            @else
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('login') }}" class="py-4 bg-slate-100 text-slate-800 text-center rounded-2xl font-bold">Connexion</a>
                    <a href="{{ route('public.apply') }}" class="py-4 bg-[#1e3a8a] text-white text-center rounded-2xl font-bold">Postuler</a>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="relative min-h-screen flex items-center mesh-gradient text-white pt-20 overflow-hidden">
        <!-- Animated Blobs -->
        <div class="hero-shape w-96 h-96 bg-blue-400 top-[-10%] right-[-5%]"></div>
        <div class="hero-shape w-80 h-80 bg-indigo-500 bottom-[-10%] left-[-5%]"></div>

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 relative z-10">
            <div data-aos="fade-right" data-aos-delay="100">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-md mb-8">
                    <span class="flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-blue-300 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-400"></span>
                    </span>
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-100">Plateforme de Stage 2026</span>
                </div>
                
                <h1 class="text-5xl lg:text-7xl font-extrabold leading-[1.1] mb-8">
                    Lancez votre <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-white">carrière</span> avec la FS Oujda
                </h1>
                
                <p class="text-lg text-blue-100/80 leading-relaxed mb-10 max-w-xl">
                    Une plateforme intelligente conçue pour connecter les talents de demain avec les meilleures opportunités de stage. Digitalisez votre parcours administratif dès aujourd'hui.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('public.apply') }}" class="group px-8 py-4 bg-white text-primary rounded-2xl font-bold text-lg flex items-center justify-center gap-3 hover:bg-blue-50 transition-all shadow-2xl shadow-blue-900/40 transform hover:-translate-y-1">
                        <i class="fa-solid fa-paper-plane"></i>
                        Postuler au stage
                    </a>
                    <a href="{{ route('public.track') }}" class="group px-8 py-4 bg-transparent border-2 border-white/30 text-white rounded-2xl font-bold text-lg flex items-center justify-center gap-3 hover:bg-white/10 transition-all transform hover:-translate-y-1">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Suivre mon dossier
                    </a>
                </div>

                <div class="mt-12 flex items-center gap-6">
                    <div class="flex -space-x-4">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" class="w-10 h-10 rounded-full border-2 border-[#1e3a8a]" alt="User">
                        <img src="https://ui-avatars.com/api/?name=User&background=2563eb&color=fff" class="w-10 h-10 rounded-full border-2 border-[#1e3a8a]" alt="User">
                        <img src="https://ui-avatars.com/api/?name=Staff&background=1e40af&color=fff" class="w-10 h-10 rounded-full border-2 border-[#1e3a8a]" alt="User">
                    </div>
                    <p class="text-sm font-medium text-blue-200">Rejoignez +1,500 stagiaires cette année</p>
                </div>
            </div>

            <!-- Hero Visual Area -->
            <div class="hidden lg:flex items-center justify-center relative" data-aos="zoom-in" data-aos-delay="300">
                <div class="orbit-container">
                    <!-- Main Card -->
                    <div class="relative z-10 glass-card p-2 rounded-[2.5rem] shadow-2xl animate-float">
                        <div class="bg-white rounded-[2rem] p-8 text-slate-800 w-[400px]">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="font-extrabold text-xl">Statut Candidature</h3>
                                <div class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold">Mis à jour</div>
                            </div>
                            <div class="space-y-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-primary">
                                        <i class="fa-solid fa-file-invoice"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="h-2 bg-slate-100 rounded-full w-full mb-2 overflow-hidden">
                                            <div class="h-full bg-primary w-3/4 animate-pulse"></div>
                                        </div>
                                        <p class="text-xs font-semibold text-slate-500">Dossier en cours de validation...</p>
                                    </div>
                                </div>
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-bold">Attestation générée</span>
                                        <i class="fa-solid fa-circle-check text-green-500"></i>
                                    </div>
                                    <p class="text-xs text-slate-500">Prêt pour téléchargement immédiat.</p>
                                </div>
                            </div>
                            <button class="w-full mt-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-blue-500/30">
                                <i class="fa-solid fa-download mr-2"></i> Télécharger
                            </button>
                        </div>
                    </div>
                    
                    <!-- Floating Icons -->
                    <div class="floating-icon top-0 left-0 animate-float" style="animation-delay: -0.5s">
                        <i class="fa-solid fa-shield-halved text-2xl text-blue-300"></i>
                    </div>
                    <div class="floating-icon bottom-10 right-0 animate-float" style="animation-delay: -1.2s">
                        <i class="fa-solid fa-rocket text-2xl text-blue-200"></i>
                    </div>
                    <div class="floating-icon top-1/4 right-[-40px] animate-float" style="animation-delay: -2s">
                        <i class="fa-solid fa-bolt text-2xl text-blue-400"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-[60px] fill-slate-50">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,121.32,201.5,114.28,242.02,110.22,282.26,98.66,321.39,56.44Z"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-32 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                <h4 class="text-primary font-black uppercase tracking-widest text-sm mb-4">Fonctionnalités Clés</h4>
                <h2 class="text-4xl md:text-5xl font-extrabold text-[#111827] mb-6">Tout ce dont vous avez besoin en un clic</h2>
                <div class="w-20 h-1.5 bg-primary mx-auto rounded-full mb-8"></div>
                <p class="text-lg text-slate-600">Simplifiez chaque étape de votre stage, de la candidature initiale jusqu'à la remise de l'attestation finale.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="glass-card p-1 rounded-3xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white rounded-[1.4rem] p-8 h-full">
                        <div class="w-14 h-14 bg-blue-50 text-primary rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-primary group-hover:text-white transition-all duration-500 shadow-inner">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Candidature Facile</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">Processus de dépôt simplifié sans création de compte. Remplissez le formulaire et envoyez vos justificatifs directement.</p>
                        <a href="{{ route('public.apply') }}" class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:gap-4 transition-all">
                            Commencer <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="glass-card p-1 rounded-3xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white rounded-[1.4rem] p-8 h-full">
                        <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500 shadow-inner">
                            <i class="fa-solid fa-radar"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Suivi Temps Réel</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">Ne restez plus dans le doute. Suivez l'avancement de votre dossier en direct grâce à votre numéro de référence unique.</p>
                        <a href="{{ route('public.track') }}" class="inline-flex items-center gap-2 text-indigo-600 font-bold text-sm hover:gap-4 transition-all">
                            Vérifier mon statut <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="glass-card p-1 rounded-3xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-white rounded-[1.4rem] p-8 h-full">
                        <div class="w-14 h-14 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-cyan-600 group-hover:text-white transition-all duration-500 shadow-inner">
                            <i class="fa-solid fa-bolt-lightning"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Attestations Instantanées</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">Une fois votre stage validé, votre attestation est générée automatiquement et disponible en téléchargement sécurisé.</p>
                        <span class="inline-flex items-center gap-2 text-cyan-600 font-bold text-sm">
                            Génération automatique <i class="fa-solid fa-sparkles text-amber-400"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 relative overflow-hidden shadow-2xl">
                <!-- Background Decorative -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 blur-[100px] rounded-full"></div>
                
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 relative z-10">
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-5xl font-black text-white mb-2">1,500+</div>
                        <div class="text-blue-400 text-xs font-bold uppercase tracking-widest">Stagiaires par an</div>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-5xl font-black text-white mb-2">120</div>
                        <div class="text-blue-400 text-xs font-bold uppercase tracking-widest">Partenaires</div>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="300">
                        <div class="text-5xl font-black text-white mb-2">98%</div>
                        <div class="text-blue-400 text-xs font-bold uppercase tracking-widest">Satisfaction</div>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="400">
                        <div class="text-5xl font-black text-white mb-2">24h</div>
                        <div class="text-blue-400 text-xs font-bold uppercase tracking-widest">Délai Réponse</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admin Preview -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">
            <div data-aos="fade-right">
                <h4 class="text-primary font-black uppercase tracking-widest text-sm mb-4">Espace Administrateur</h4>
                <h2 class="text-4xl font-extrabold text-[#111827] mb-6">Une gestion centralisée et pilotée par la donnée</h2>
                <p class="text-lg text-slate-600 mb-8 font-medium">L'administration dispose d'un tableau de bord puissant pour valider les dossiers, extraire des rapports PDF/Excel et gérer les cycles de stage en toute simplicité.</p>
                
                <ul class="space-y-4 mb-10">
                    <li class="flex items-center gap-3 text-slate-700 font-semibold">
                        <div class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs shadow-sm">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        Validation de masse des candidatures
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-semibold">
                        <div class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs shadow-sm">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        Génération automatique d'attestations certifiées
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-semibold">
                        <div class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs shadow-sm">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        Statistiques avancées en temps réel
                    </li>
                </ul>

                <a href="{{ route('login') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-black transition-all shadow-xl">
                    Accès Administrateur <i class="fa-solid fa-lock text-slate-400"></i>
                </a>
            </div>

            <div class="relative" data-aos="fade-left">
                <div class="glass-card p-1 rounded-[2.5rem] rotate-2 transition-transform hover:rotate-0 duration-500">
                    <div class="bg-slate-50 rounded-[2rem] p-6 shadow-inner">
                        <!-- Mockup Image or Content -->
                        <div class="h-64 bg-white rounded-xl shadow-sm border border-slate-200 p-4 space-y-4">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg"></div>
                                <div class="h-2 bg-slate-100 rounded-full w-24"></div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="h-20 bg-slate-50 rounded-xl border border-slate-100 overflow-hidden">
                                     <div class="h-1 bg-blue-500 w-full"></div>
                                </div>
                                <div class="h-20 bg-slate-50 rounded-xl border border-slate-100 overflow-hidden">
                                     <div class="h-1 bg-green-500 w-full"></div>
                                </div>
                                <div class="h-20 bg-slate-50 rounded-xl border border-slate-100 overflow-hidden">
                                     <div class="h-1 bg-yellow-500 w-full"></div>
                                </div>
                            </div>
                            <div class="h-24 bg-slate-50 rounded-xl border border-slate-100 animate-pulse"></div>
                        </div>
                    </div>
                </div>
                <!-- Decorative elements behind -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-yellow-400/20 blur-2xl rounded-full"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12 mb-20">
                <div class="col-span-2">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg p-1.5 overflow-hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/fr/b/bd/Logo_Universit%C3%A9_Mohammed_Ier.png" alt="Logo UMP" class="w-full h-full object-contain">
                        </div>
                        <span class="text-xl font-black text-white">FS Oujda</span>
                    </div>
                    <p class="max-w-xs leading-relaxed mb-8">
                        Faculté des Sciences, Université Mohammed Premier Oujda. L'excellence académique à l'ère du numérique.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white hover:bg-primary transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white hover:bg-primary transition-colors"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white hover:bg-primary transition-colors"><i class="fa-brands fa-twitter"></i></a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-6">Liens Rapides</h5>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-primary transition-colors">Accueil</a></li>
                        <li><a href="{{ route('public.apply') }}" class="hover:text-primary transition-colors">Postuler</a></li>
                        <li><a href="{{ route('public.track') }}" class="hover:text-primary transition-colors">Suivi de dossier</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-primary transition-colors">Connexion Admin</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-6">Contact</h5>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2"><i class="fa-solid fa-location-dot mt-1 text-primary"></i> BV Mohammed VI, BP 717, Oujda</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-phone text-primary"></i> +212 536 50 06 01</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-envelope text-primary"></i> contact@ump.ac.ma</li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-12 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6 text-xs uppercase tracking-widest font-bold">
                <p>&copy; 2026 Faculté des Sciences Oujda. Design Premium.</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-white transition-colors">Mentions Légales</a>
                    <a href="#" class="hover:text-white transition-colors">Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('main-nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-xl', 'bg-white/90');
                nav.classList.remove('bg-white/70');
            } else {
                nav.classList.remove('shadow-xl', 'bg-white/90');
                nav.classList.add('bg-white/70');
            }
        });
    </script>
</body>
</html>