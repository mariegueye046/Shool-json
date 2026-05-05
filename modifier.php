<?php
session_start();

// Vérification que l'utilisateur est admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: connexion.php");
    exit();
}

// Récupération de l'ID passé en GET
$id = $_GET['id'] ?? null;
if ($id === null) {
    die("Aucun utilisateur sélectionné");
}

// Chargement des données JSON
$contenu = file_get_contents("data.json");
$data = json_decode($contenu, true) ?? [];

// Recherche de l'utilisateur correspondant
$utilisateur = null;
foreach ($data as $index => $u) {
    if ($u['id'] == $id) {
        $utilisateur = $u;
        $indexUtilisateur = $index; // pour modifier directement
        break;
    }
}

if (!$utilisateur) {
    die("Utilisateur introuvable");
}

// Traitement POST pour modifier l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data[$indexUtilisateur]['nom'] = $_POST['nom'] ?? $utilisateur['nom'];
    $data[$indexUtilisateur]['email'] = $_POST['email'] ?? $utilisateur['email'];
    $data[$indexUtilisateur]['statut'] = $_POST['statut'] ?? $utilisateur['statut'];

    // Sauvegarde dans le JSON
    file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));

    // Redirection vers le dashboard admin
    header("Location: accueil_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Étudiant | Telly Tech Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-900 min-h-screen flex items-center justify-center p-4">

    <!-- Bouton Retour -->
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
            
            <!-- Header avec avatar actuel -->
            <div class="p-8 md:p-12 pb-0 flex flex-col md:flex-row items-center gap-6">
                <div class="relative">
                    <img src="<?= $utilisateur['photo'] ?>" class="w-20 h-20 rounded-2xl object-cover ring-4 ring-slate-50 shadow-md">
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-blue-600 rounded-full border-4 border-white flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">Modifier le profil</h2>
                    <p class="text-slate-500 text-sm mt-1 uppercase font-bold tracking-widest opacity-60">ID Étudiant: #<?= htmlspecialchars($id) ?></p>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <form method="POST" action="" class="space-y-6">
                    
                    <!-- Champ Nom -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 ml-1">Nom complet de l'étudiant</label>
                        <div class="relative">
                            <input type="text" name="nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required
                                class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm font-medium">
                            <svg class="absolute left-4 top-4 w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    </div>

                    <!-- Champ Email -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 ml-1">Adresse Email professionnelle</label>
                        <div class="relative">
                            <input type="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required
                                class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm font-medium">
                            <svg class="absolute left-4 top-4 w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>

                    <!-- Champ Statut -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400 ml-1">Statut d'accès</label>
                        <div class="relative">
                            <select name="statut" required
                                class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white outline-none transition-all text-sm font-bold appearance-none cursor-pointer">
                                <option value="validé" <?= ($utilisateur['statut'] === 'validé') ? 'selected' : '' ?>>Compte Validé</option>
                                <option value="en_attente" <?= ($utilisateur['statut'] === 'en_attente') ? 'selected' : '' ?>>En attente de validation</option>
                            </select>
                            <svg class="absolute left-4 top-4 w-5 h-5 text-slate-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <svg class="absolute right-4 top-4 w-5 h-5 text-slate-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-4 pt-6">
                        <button type="submit" 
                            class="flex-1 bg-blue-600 text-white font-bold py-4 rounded-2xl hover:bg-blue-700 shadow-xl shadow-blue-100 transition-all transform active:scale-[0.98]">
                            Enregistrer les modifications
                        </button>
                        <a href="accueil_admin.php" 
                            class="px-8 py-4 bg-slate-100 text-slate-500 font-bold rounded-2xl hover:bg-slate-200 transition-all text-sm">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>

            <!-- Footer info -->
            <div class="bg-slate-50 p-6 border-t border-slate-100 text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                Dernière modification par : Admin System
            </div>
        </div>
    </div>

</body>
</html>



