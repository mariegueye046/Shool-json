<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Telly Tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="bg-[#0f172a] text-white min-h-screen flex items-center justify-center p-6 overflow-hidden">

    <!-- Cercles lumineux décoratifs en arrière-plan -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-[20%] left-[10%] w-72 h-72 bg-blue-600/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[20%] right-[10%] w-72 h-72 bg-purple-600/20 rounded-full blur-[100px]"></div>
    </div>

    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-10">
            <a href="index.php" class="text-3xl font-[800] tracking-tighter hover:opacity-80 transition-opacity">
                TELLY<span class="text-blue-500">.</span>TECH
            </a>
        </div>

        <!-- Formulaire de connexion -->
        <div class="glass-card rounded-[32px] p-8 md:p-10 shadow-2xl">
            <div class="mb-8">
                <h2 class="text-2xl font-bold">Content de vous revoir</h2>
                <p class="text-gray-400 text-sm mt-2">Entrez vos identifiants pour accéder à votre espace.</p>
            </div>

            <form action="traitement_connexion.php" method="POST" class="space-y-6">
                
                <!-- Email -->
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-gray-500 ml-1">Email</label>
                    <input type="email" name="email" required autocomplete="username"
                        placeholder="exemple@telly.com"
                        class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white/10 outline-none transition-all text-sm placeholder:text-gray-600">
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="text-xs font-bold uppercase tracking-widest text-gray-500 ml-1">Mot de passe</label>
                    </div>
                    <input type="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white/10 outline-none transition-all text-sm placeholder:text-gray-600">
                </div>

                <!-- Message d'erreur PHP -->
                <?php if(!empty($error)): ?>
                    <div class="bg-red-500/10 border border-red-500/20 p-4 rounded-xl">
                        <p class="text-red-400 text-xs font-medium text-center"><?= $error ?></p>
                    </div>
                <?php endif; ?>

                <!-- Bouton de connexion -->
                <button type="submit" 
                    class="w-full bg-blue-600 text-white font-bold py-4 rounded-2xl hover:bg-blue-500 shadow-lg shadow-blue-600/20 transition-all duration-300 transform active:scale-[0.98] mt-4">
                    Se connecter
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-white/5 text-center">
                <p class="text-gray-500 text-sm">
                    Pas encore de compte ? 
                    <a href="inscription.php" class="text-blue-400 font-bold hover:text-blue-300 transition-colors">S'inscrire</a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center mt-10 text-gray-600 text-[10px] font-bold uppercase tracking-[0.2em]">
            Secured by Telly Tech Cloud
        </p>
    </div>

</body>
</html>