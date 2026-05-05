<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Étudiant | Telly Tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-900 min-h-screen flex items-center justify-center p-4">

    <!-- Bouton Retour rapide -->
    <div class="fixed top-8 left-8">
        <a href="accueil_admin.php" class="flex items-center text-slate-400 hover:text-blue-600 transition-colors font-semibold text-sm group">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour au Dashboard
        </a>
    </div>

    <div class="w-full max-w-2xl">
        <div class="bg-white rounded-[40px] shadow-2xl shadow-blue-900/5 border border-slate-100 overflow-hidden">
            
            <div class="p-8 md:p-12">
                <!-- Header du formulaire -->
                <div class="mb-10">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900">Nouvel Étudiant</h2>
                    <p class="text-slate-500 mt-2">Remplissez les informations pour créer un compte avec <span class="text-blue-600 font-semibold">validation directe</span>.</p>
                </div>

                <form action="traitement_ajout_admin.php" method="POST" enctype="multipart/form-data" autocomplete="off" class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 ml-1">Nom complet</label>
                            <input type="text" name="nom" required placeholder="Ex: Moussa Diop"
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm">
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 ml-1">Adresse Email</label>
                            <input type="email" name="email" required autocomplete="new-password" placeholder="moussa@telly.tech"
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 ml-1">Mot de passe temporaire</label>
                            <input type="password" name="password" required autocomplete="new-password" placeholder="••••••••"
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm">
                        </div>

                        <!-- Adresse -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 ml-1">Ville / Adresse</label>
                            <input type="text" name="adress" required placeholder="Dakar, Plateau"
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm">
                        </div>
                    </div>

                    <!-- Upload Photo de profil -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 ml-1">Photo de profil</label>
                        <div class="relative group">
                            <input type="file" name="photo" accept="image/*" required
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="w-full px-5 py-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center group-hover:border-blue-400 group-hover:bg-blue-50/30 transition-all">
                                <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-slate-400 group-hover:text-blue-600 mb-3 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-xs font-semibold text-slate-500">Cliquez pour uploader une photo</p>
                                <p class="text-[10px] text-slate-400 mt-1">PNG, JPG jusqu'à 5MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Buttons -->
                    <div class="flex items-center gap-4 pt-6">
                        <button type="submit" 
                            class="flex-1 bg-slate-900 text-white font-bold py-4 rounded-2xl hover:bg-blue-600 shadow-xl shadow-slate-200 transition-all transform active:scale-[0.98]">
                            Créer l'étudiant
                        </button>
                        <a href="accueil_admin.php" 
                            class="px-8 py-4 bg-slate-100 text-slate-500 font-bold rounded-2xl hover:bg-slate-200 transition-all text-sm">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>

            <!-- Footer info -->
            <div class="bg-slate-50 p-6 border-t border-slate-100 text-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Opération sécurisée par Telly Tech Admin</p>
            </div>
        </div>
    </div>

</body>
</html>