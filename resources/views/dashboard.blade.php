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
            <!-- Dashboard (Active) -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/10 text-white font-semibold transition-colors border border-white/10 shadow-sm w-full group">
                <i class="fa-solid fa-chart-pie w-5 text-center text-blue-200 group-hover:text-white transition-colors"></i> 
                Tableau de Bord
            </a>

            <div class="pt-4 pb-1">
                <p class="px-4 text-xs font-bold text-blue-300/70 uppercase tracking-widest">Gestion</p>
            </div>

            <a href="{{ url('/stagiaires') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-blue-100 hover:bg-white/5 hover:text-white font-medium transition-colors w-full group">
                <i class="fa-solid fa-users w-5 text-center text-blue-300/70 group-hover:text-white transition-colors"></i> 
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
                <h2 class="text-2xl font-extrabold text-[#1e3a8a] tracking-tight">Vue d'ensemble</h2>
                <p class="text-sm text-gray-500 font-medium mt-0.5">Bienvenue dans votre espace d'administration</p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ url('/stagiaires/create') }}" class="hidden sm:flex items-center gap-2 bg-[#1e3a8a] hover:bg-[#152e75] text-white px-5 py-2.5 rounded-lg font-semibold shadow-md shadow-blue-900/20 transition-all border border-blue-800 transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-plus text-sm"></i>
                    Nouveau Stagiaire
                </a>
                
                <div class="h-10 w-10 rounded-full bg-blue-100 border-2 border-white shadow-sm flex items-center justify-center text-[#1e3a8a] cursor-pointer hover:ring-2 hover:ring-blue-400 transition-all">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </header>

        <!-- Scrollable Content Layout -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-8">
            <div class="max-w-7xl mx-auto space-y-8 pb-10">

                <!-- KPI Cards Grid -->
                <!-- Note: The grid puts 4 in a row. They wrap correctly on smaller screens. -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- KPI: Total Stagiaires -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
                        <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-users text-8xl text-[#1e3a8a]"></i>
                        </div>
                        <div class="flex flex-col relative z-10">
                            <div class="w-12 h-12 bg-blue-50 text-[#1e3a8a] rounded-xl flex items-center justify-center text-xl mb-4 border border-blue-100">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Total Stagiaires</h3>
                            <div class="text-4xl font-extrabold text-gray-900">{{ $total }}</div>
                        </div>
                    </div>

                    <!-- KPI: En Attente -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group" data-aos="fade-up" data-aos-delay="200">
                        <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-clock text-8xl text-yellow-500"></i>
                        </div>
                        <div class="flex flex-col relative z-10">
                            <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center text-xl mb-4 border border-yellow-100">
                                <i class="fa-solid fa-hourglass-half"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">En attente</h3>
                            <div class="text-4xl font-extrabold text-gray-900">{{ $pending }}</div>
                        </div>
                    </div>

                    <!-- KPI: Acceptés -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group" data-aos="fade-up" data-aos-delay="300">
                        <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-check-circle text-8xl text-green-500"></i>
                        </div>
                        <div class="flex flex-col relative z-10">
                            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl mb-4 border border-green-100">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Acceptés</h3>
                            <div class="text-4xl font-extrabold text-gray-900">{{ $accepted }}</div>
                        </div>
                    </div>

                    <!-- KPI: Rejetés -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group" data-aos="fade-up" data-aos-delay="400">
                        <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-xmark-circle text-8xl text-red-500"></i>
                        </div>
                        <div class="flex flex-col relative z-10">
                            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-xl mb-4 border border-red-100">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Rejetés</h3>
                            <div class="text-4xl font-extrabold text-gray-900">{{ $rejected }}</div>
                        </div>
                    </div>

                </div>

                <!-- Charts Section Wrapper -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="500">
                    
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-white">
                        <div class="flex flex-col">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fa-solid fa-chart-line text-[#3b82f6]"></i> Évolution des Inscriptions
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">Activité des stagiaires sur les 7 derniers jours</p>
                        </div>
                        <div class="hidden sm:flex bg-gray-100 p-1 rounded-lg">
                            <button class="px-3 py-1.5 bg-white shadow-sm rounded-md text-xs font-bold text-[#1e3a8a]">7 Jours</button>
                            <button class="px-3 py-1.5 text-gray-500 hover:text-gray-900 font-medium text-xs rounded-md transition-colors">30 Jours</button>
                        </div>
                    </div>

                    <!-- Chart Canvas Area -->
                    <div class="p-6 h-[400px] w-full relative">
                        <canvas id="stagiairesChart"></canvas>
                    </div>

                </div>

            </div>
        </div>
    </main>
</div>

<!-- Add FontAwesome to Layout if not present globally -->
<script src="https://kit.fontawesome.com/your-code-here.js" crossorigin="anonymous"></script>

<!-- Chart.js Setup -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const labels = @json($labels);
        const data = @json($data);

        // Chart configuration with modern academic styling
        const ctx = document.getElementById('stagiairesChart').getContext('2d');
        
        // Setup a beautiful gradient for the line chart fill
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.2)'); // theme secondary blue
        gradient.addColorStop(1, 'rgba(30, 58, 138, 0)');    // theme primary blue to transparent

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Stagiaires Inscrits',
                    data: data,
                    borderColor: '#3b82f6', // Bright Secondary Blue
                    backgroundColor: gradient,
                    borderWidth: 3,
                    tension: 0.4, // Smooth curved lines
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#1e3a8a', // Dark Academic Blue
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#1e3a8a',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e3a8a',
                        titleFont: { size: 13, family: 'Inter' },
                        bodyFont: { size: 14, family: 'Inter', weight: 'bold' },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                    }
                },
                scales: {
                    x: { 
                        grid: { display: false, drawBorder: false },
                        ticks: { font: { family: 'Inter' }, color: '#64748b' }
                    },
                    y: { 
                        beginAtZero: true, 
                        grid: { 
                            color: '#f1f5f9',
                            drawBorder: false,
                            borderDash: [5, 5]
                        },
                        ticks: { 
                            precision: 0,
                            font: { family: 'Inter' },
                            color: '#64748b',
                            padding: 10
                        } 
                    }
                }
            }
        });
    });
</script>

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