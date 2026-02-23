<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Authentification</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
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

            .glass-panel {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.4);
            }
        </style>
    </head>
    <body class="antialiased overflow-x-hidden">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 px-4 sm:px-0 mesh-gradient relative">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-400 opacity-20 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-500 opacity-20 blur-[100px] rounded-full"></div>

            <div class="z-10 w-full max-w-md" data-aos="zoom-in" data-aos-duration="600">
                <div class="flex flex-col items-center mb-8">
                    <a href="/" class="group">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-2xl transform transition-transform group-hover:rotate-12 overflow-hidden p-2">
                            <img src="https://upload.wikimedia.org/wikipedia/fr/b/bd/Logo_Universit%C3%A9_Mohammed_Ier.png" alt="Logo UMP" class="w-full h-full object-contain">
                        </div>
                    </a>
                    <h1 class="text-white text-2xl font-extrabold mt-6 tracking-tight">Accès Sécurisé</h1>
                    <p class="text-blue-200 text-sm mt-2 font-medium">Administration | FS Oujda</p>
                </div>

                <div class="glass-panel w-full p-8 sm:p-10 shadow-3xl rounded-[2.5rem] border border-white/20">
                    {{ $slot }}
                </div>
                
                <div class="mt-8 text-center">
                    <p class="text-blue-100/60 text-xs font-bold uppercase tracking-widest">&copy; 2026 Faculté des Sciences Oujda</p>
                </div>
            </div>
        </div>
    </body>
</html>
