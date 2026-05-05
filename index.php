<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telly Tech | Formation en ligne</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-[#0f172a] text-white overflow-x-hidden">

    <!-- Décoration d'arrière-plan (Cercles flous) -->
    <div class="fixed top-0 left-0 w-full h-full -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-900/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-900/20 rounded-full blur-[120px]"></div>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center px-6">
        
        <!-- Header / Logo -->
        <header class="absolute top-8 left-0 w-full px-8 flex justify-center md:justify-start">
            <h1 class="text-2xl font-[800] tracking-tighter">TELLY<span class="text-blue-500">.</span>TECH</h1>
        </header>

        <!-- Main Content -->
        <main class="max-w-4xl w-full text-center space-y-8 mt-12">
            
            <div class="space-y-4">
                <span class="inline-block px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-widest animate-pulse">
                    Le futur de l'apprentissage
                </span>
                
                <h2 class="text-5xl md:text-7xl font-[800] tracking-tight leading-[1.1]">
                    WELCOME TO <br>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-emerald-400">
                        TELLY TECH
                    </span>
                </h2>
                
                <p class="text-gray-400 text-lg md:text-xl max-w-xl mx-auto font-medium">
                    La plateforme de cours en ligne pour maîtriser les technologies de demain.
                </p>
            </div>

            <!-- Actions (Boutons) -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-6">
                <!-- Se connecter -->
                <a href="connexion.php" 
                   class="w-full sm:w-auto px-10 py-4 bg-white text-black font-bold rounded-2xl hover:bg-blue-500 hover:text-white transition-all duration-300 transform hover:-translate-y-1 shadow-xl shadow-white/5">
                   Se connecter
                </a>

                <!-- S'inscrire -->
                <a href="inscription.php" 
                   class="w-full sm:w-auto px-10 py-4 glass text-white font-bold rounded-2xl hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1">
                   S'inscrire
                </a>
            </div>

            <!-- Preuve sociale / Stats (Optionnel pour faire pro) -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-8 pt-16 border-t border-white/5 max-w-2xl mx-auto">
                <div>
                    <p class="text-2xl font-bold text-white">20+</p>
                    <p class="text-gray-500 text-xs uppercase font-semibold">Cours</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-white">500+</p>
                    <p class="text-gray-500 text-xs uppercase font-semibold">Étudiants</p>
                </div>
                <div class="hidden md:block">
                    <p class="text-2xl font-bold text-white">24/7</p>
                    <p class="text-gray-500 text-xs uppercase font-semibold">Support</p>
                </div>
            </div>

        </main>

        <!-- Footer -->
        <footer class="absolute bottom-8 text-gray-500 text-[10px] uppercase tracking-widest font-bold">
            Innovation & Éducation &copy; 2026
        </footer>

    </div>

</body>
</html>