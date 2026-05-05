<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: connexion.php");
    exit();
}

$id = $_GET['id'];

$contenu = file_get_contents("data.json");
$data = json_decode($contenu, true);

$utilisateur = $data[$id];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?= $utilisateur['nom']; ?> | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-4">

    <!-- Décoration de fond -->
    <div class="fixed top-0 left-0 w-full h-1 bg-blue-600"></div>

    <div class="w-full max-w-lg">
        
        <!-- Bouton Retour -->
        <a href="accueil_admin.php" class="inline-flex items-center text-slate-400 hover:text-slate-600 mb-6 transition-colors text-sm font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour à la liste
        </a>

        <div class="bg-white rounded-[40px] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            
            <!-- En-tête Profil -->
            <div class="p-8 pb-0 text-center">
                <div class="relative inline-block group">
                    <img src="<?= $utilisateur['photo']; ?>" 
                         alt="Photo de <?= $utilisateur['nom']; ?>"
                         class="w-32 h-32 rounded-[32px] object-cover ring-4 ring-slate-50 shadow-lg mx-auto transition-transform group-hover:scale-105 duration-300">
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 rounded-full border-4 border-white flex items-center justify-center shadow-sm <?= ($utilisateur['statut'] === 'validé') ? 'bg-green-500' : 'bg-orange-400'; ?>">
                        <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    </div>
                </div>
                
                <h2 class="mt-6 text-2xl font-bold text-slate-900 tracking-tight"><?= $utilisateur['nom']; ?></h2>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-[0.2em] mt-1">Dossier Étudiant</p>
            </div>

            <!-- Contenu des informations -->
            <div class="p-8 space-y-4">
                
                <div class="grid grid-cols-1 gap-3">
                    <!-- Email Card -->
                    <div class="flex items-center p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-blue-500 mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Adresse Email</p>
                            <p class="text-sm font-semibold text-slate-700"><?= $utilisateur['email']; ?></p>
                        </div>
                    </div>

                    <!-- Adresse Card -->
                    <div class="flex items-center p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-blue-500 mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Localisation</p>
                            <p class="text-sm font-semibold text-slate-700"><?= $utilisateur['adress']; ?></p>
                        </div>
                    </div>

                    <!-- Statut Card -->
                    <div class="flex items-center p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-blue-500 mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="flex-1 flex justify-between items-center">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">État du compte</p>
                                <p class="text-sm font-semibold <?= ($utilisateur['statut'] === 'validé') ? 'text-green-600' : 'text-orange-500'; ?>">
                                    <?= ucfirst($utilisateur['statut']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Zone d'action décisive -->
                <div class="pt-6 flex flex-col gap-3">
                    <?php if ($utilisateur['statut'] !== 'validé'): ?>
                    <a href="valider.php?id=<?= $id; ?>" 
                       class="w-full py-4 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 shadow-lg shadow-green-100 transition-all text-center">
                        Valider l'inscription
                    </a>
                    <?php endif; ?>
                    
                    <a href="accueil_admin.php" 
                       class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-all text-center">
                        Laisser en attente
                    </a>
                </div>

                <div class="text-center pt-4">
                    <a href="accueil_admin.php" class="text-xs font-bold text-slate-300 hover:text-slate-400 uppercase tracking-widest transition-colors">
                        Fermer le dossier
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>