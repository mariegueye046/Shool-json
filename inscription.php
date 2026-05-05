<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Telly Tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] flex items-center justify-center min-h-screen p-4">

    <!-- Décoration de fond discrète -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-[10%] -right-[10%] w-[30%] h-[30%] bg-blue-100/50 rounded-full blur-[80px]"></div>
        <div class="absolute -bottom-[10%] -left-[10%] w-[30%] h-[30%] bg-indigo-100/50 rounded-full blur-[80px]"></div>
    </div>

    <div class="w-full max-w-[500px]">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="index.php" class="text-2xl font-[800] tracking-tighter text-black">
                TELLY<span class="text-blue-600">.</span>TECH
            </a>
        </div>

        <!-- Carte d'inscription -->
        <div class="bg-white rounded-[32px] shadow-2xl shadow-blue-900/5 p-8 md:p-10 border border-gray-100">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Créer un compte</h2>
                <p class="text-sm text-gray-400 mt-1">Rejoignez la plateforme et commencez à apprendre.</p>
            </div>

            <!-- Ton action PHP pour l'inscription -->
            <form action="traitement_inscription.php" method="POST" enctype="multipart/form-data" class="space-y-5">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Nom -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 ml-1">Nom complet</label>
                        <input type="text" name="nom" required placeholder="Marie Gueye"
                            class="w-full px-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm">
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 ml-1">Email</label>
                        <input type="email" name="email" required placeholder="marie@exemple.com"
                            class="w-full px-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm">
                    </div>
                </div>

                <!-- Adresse -->
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 ml-1">Adresse de résidence</label>
                    <input type="text" name="adress" required placeholder="Dakar, Sénégal"
                        class="w-full px-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm">
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 ml-1">Mot de passe</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm">
                </div>

                <!-- Photo de profil (Design épuré) -->
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 ml-1">Photo de profil</label>
                    <label class="flex items-center justify-center w-full h-24 px-4 transition bg-gray-50 border-2 border-gray-100 border-dashed rounded-2xl appearance-none cursor-pointer hover:border-blue-600 focus:outline-none">
                        <span class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <span class="text-xs font-medium text-gray-500">Choisir une image...</span>
                        </span>
                        <input type="file" name="photo" class="hidden">
                    </label>
                </div>

                <!-- Affichage erreur -->
                <?php if(!empty($error)): ?>
                    <p class="text-xs text-red-500 font-semibold text-center bg-red-50 py-2 rounded-lg border border-red-100"><?= $error ?></p>
                <?php endif; ?>

                <!-- Bouton -->
                <button type="submit" 
                    class="w-full bg-blue-600 text-white font-bold py-4 rounded-2xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all transform active:scale-[0.98] mt-2">
                    Créer mon compte
                </button>
            </form>

            <p class="text-center mt-6 text-sm text-gray-500">
                Déjà inscrit ? <a href="connexion.php" class="text-blue-600 font-bold hover:underline">Se connecter</a>
            </p>
        </div>
    </div>

</body>
</html>