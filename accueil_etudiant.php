<?php
session_start();


$utilisateur_trouve = $_SESSION['utilisateur_trouve'] ?? null;


if (!$utilisateur_trouve || $_SESSION['role'] !== "etudiant") {
    header("Location: connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace | Telly Tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .profile-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%);
        }
    </style>
</head>
<body class="bg-[#f1f5f9] min-h-screen flex items-center justify-center p-4">

    <!-- Arrière-plan décoratif -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[300px] profile-gradient rounded-b-[100px] opacity-20 blur-3xl"></div>
    </div>

    <div class="w-full max-w-md">
        
        <!-- Logo Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-[800] tracking-tighter text-slate-900 uppercase">
                Telly<span class="text-blue-600">.</span>Tech
            </h1>
            <p class="text-xs font-bold text-slate-400 tracking-[0.2em] mt-1 uppercase">Student Portal</p>
        </div>

        <!-- Carte de profil principale -->
        <div class="bg-white rounded-[40px] shadow-2xl shadow-blue-900/10 overflow-hidden border border-white">
            
            <!-- Bannière colorée derrière la photo -->
            <div class="h-32 profile-gradient relative">
                <div class="absolute -bottom-12 left-1/2 -translate-x-1/2">
                    <div class="relative">
                        <img src="<?= $utilisateur_trouve['photo']; ?>" 
                             alt="Photo de <?= $utilisateur_trouve['nom']; ?>"
                             class="w-24 h-24 rounded-3xl object-cover border-4 border-white shadow-xl rotate-3 hover:rotate-0 transition-transform duration-300">
                        <!-- Badge de statut en ligne -->
                        <div class="absolute bottom-1 right-1 w-5 h-5 bg-green-500 border-4 border-white rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Infos de l'étudiant -->
            <div class="pt-16 pb-10 px-8 text-center">
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                    <?= $utilisateur_trouve['nom']; ?>
                </h2>
                <span class="inline-block mt-2 px-4 py-1 bg-green-50 text-green-600 text-[10px] font-bold uppercase tracking-widest rounded-full border border-green-100">
                    <?= $utilisateur_trouve['statut']; ?>
                </span>

                <!-- Liste des détails -->
                <div class="mt-8 space-y-4 text-left">
                    <div class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-10 h-10 flex items-center justify-center bg-white rounded-xl shadow-sm mr-4 text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Email</p>
                            <p class="text-sm font-semibold text-slate-700"><?= $utilisateur_trouve['email']; ?></p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-10 h-10 flex items-center justify-center bg-white rounded-xl shadow-sm mr-4 text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Localisation</p>
                            <p class="text-sm font-semibold text-slate-700"><?= $utilisateur_trouve['adress'] ?? 'Non renseignée'; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-10 pt-8 border-t border-slate-50 flex flex-col gap-3">
                    <a href="modifier_profil.php" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-blue-600 transition-all shadow-lg shadow-slate-200">
                        Modifier mes infos
                    </a>
                    <a href="deconnexion.php" class="w-full py-4 bg-white text-red-500 font-bold rounded-2xl border border-red-50 border-b-2 border-b-red-100 hover:bg-red-50 transition-all text-sm">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center mt-8 text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em]">
            &copy; 2026 Telly Tech Learning Platform
        </p>
    </div>

</body>
</html>
