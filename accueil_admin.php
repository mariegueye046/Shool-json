<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: connexion.php");
    exit();
}

$contenu = file_get_contents("data.json");
$data = json_decode($contenu, true) ?? [];

$totaletud = 0;
$actif = 0;
$non_actif = 0;

foreach($data as $utilisateur){
    // On ne compte QUE si c'est un étudiant
    if($utilisateur['role'] === "etudiant") {
        $totaletud++; 
        
        if ($utilisateur['statut'] === "validé") {
            $actif++;
        } elseif ($utilisateur['statut'] === "en_attente") {
            $non_actif++;
        }
    }
}



$recherche = isset($_GET['q']) ? trim($_GET['q']) : '';
$statutFiltre = $_GET['statut'] ?? '';


$etudiants_filtres = [];
foreach ($data as $index => $utilisateur) {
    if ($utilisateur['role'] === "etudiant") {
$match = 
    (empty($recherche) || stripos($utilisateur['nom'], $recherche) !== false)
    &&
    (empty($statutFiltre) || $utilisateur['statut'] === $statutFiltre);

        
        if ($match) {
            $utilisateur['original_index'] = $index;
            $etudiants_filtres[] = $utilisateur;
        }
    }
}

$parPage = 4;
$totalResultats = count($etudiants_filtres);
$nombreDePages = ceil($totalResultats / $parPage);
$pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($pageActuelle < 1) $pageActuelle = 1;
if ($pageActuelle > $nombreDePages && $nombreDePages > 0) $pageActuelle = $nombreDePages;

$indiceDepart = ($pageActuelle - 1) * $parPage;
$etudiantsPage = array_slice($etudiants_filtres, $indiceDepart, $parPage);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Telly Tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link:hover { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .status-pill-valid { background: #ecfdf5; color: #059669; }
        .status-pill-pending { background: #fff7ed; color: #d97706; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-900">

    <div class="flex min-h-screen">
        
        <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col p-6 space-y-8">
            <div class="text-xl font-bold tracking-tighter">TELLY<span class="text-blue-600">.</span>TECH</div>
            <!-- Bouton Déconnexion dans la Sidebar -->
<div class="pt-10">
    <a href="deconnexion.php" class="flex items-center space-x-3 p-3 rounded-xl text-red-500 hover:bg-red-50 transition-all font-bold">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
        <span>Déconnexion</span>
    </a>
</div>
            <nav class="flex-1 space-y-1">
                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl bg-blue-50 text-blue-600 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl text-slate-500 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Étudiants</span>
                </a>
                <a href="#" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl text-slate-500 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Notes</span>
                </a>
            </nav>

            <div class="pt-6 border-t border-slate-100 text-xs text-slate-400">
                Connecté en tant que : <br>
                <span class="font-bold text-slate-700"><?= $_SESSION['utilisateur_trouve']['nom'] ?></span>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-4 md:p-10 space-y-10">
            
            <!-- HEADER -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <?php if (isset($_GET['status']) && $_GET['status'] === 'validated'): ?>
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl flex items-center animate-bounce">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <span class="text-sm font-bold">L'étudiant a été validé avec succès !</span>
    </div>
<?php endif; ?>
                    <h1 class="text-3xl font-bold tracking-tight">Vue d'ensemble</h1>
                    <p class="text-slate-500 text-sm mt-1">Gérez vos étudiants et suivez leurs activités.</p>
                </div>
                <a href="ajouter_etudiant.php" class="inline-flex items-center justify-center px-6 py-3 bg-slate-900 text-white font-bold rounded-2xl hover:bg-blue-600 transition-all shadow-lg shadow-slate-200">
                    <span class="mr-2">+</span> Ajouter un Étudiant
                </a>
            </div>

            <!-- STATS CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Total Étudiants</p>
                    <h3 class="text-3xl font-bold mt-2"><?= $totaletud ?></h3>
                </div>
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm">
                    <p class="text-blue-500 text-xs font-bold uppercase tracking-widest">Étudiants Actifs</p>
                    <h3 class="text-3xl font-bold mt-2"><?= $actif ?></h3>
                </div>
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm">
                    <p class="text-orange-500 text-xs font-bold uppercase tracking-widest">En attente</p>
                    <h3 class="text-3xl font-bold mt-2"><?= $non_actif ?></h3>
                </div>
            </div>

            <!-- FILTRES & TABLEAU -->
            <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm overflow-hidden">
                
                <!-- BARRE DE RECHERCHE -->
                <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-4 justify-between items-center">
                    <form method="GET" class="relative w-full md:w-96">
                        <input type="text" name="q" value="<?= htmlspecialchars($recherche) ?>" placeholder="Rechercher un nom..." class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none transition-all">
                        <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </form>
                    
                    <form method="GET">
                        <select name="statut" onchange="this.form.submit()" class="px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none focus:ring-2 focus:ring-blue-600 text-sm font-medium">
                            <option value="">Tous les statuts</option>
                            <option value="validé" <?= ($statutFiltre === 'validé') ? 'selected' : '' ?>>Validé</option>
                            <option value="en_attente" <?= ($statutFiltre === 'en_attente') ? 'selected' : '' ?>>En attente</option>
                        </select>
                    </form>
                </div>

                <!-- TABLEAU -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50/50">
                            <tr class="text-slate-400 text-[10px] font-bold uppercase tracking-widest border-b border-slate-50">
                                <th class="px-6 py-4">Profil</th>
                                <th class="px-6 py-4">Nom</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Statut</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($etudiantsPage as $utilisateur): ?>
                           <!-- ... dans ton foreach ($etudiantsPage as $utilisateur) ... -->
<tr class="hover:bg-slate-50/50 transition-colors">
    <td class="px-6 py-4">
        <!-- Lien sur la photo -->
        <a href="Details.php?id=<?= $utilisateur['original_index'] ?>">
            <img src="<?= $utilisateur['photo'] ?>" class="w-10 h-10 rounded-full object-cover ring-2 ring-white hover:ring-blue-400 transition-all">
        </a>
    </td>
    <td class="px-6 py-4">
        <!-- Lien sur le nom -->
        <a href="Details.php?id=<?= $utilisateur['original_index'] ?>" class="font-semibold text-sm hover:text-blue-600 transition-colors">
            <?= $utilisateur['nom'] ?>
        </a>
    </td>
    <td class="px-6 py-4 text-sm text-slate-500"><?= $utilisateur['email'] ?></td>
    <td class="px-6 py-4 text-xs">
        <span class="px-3 py-1 rounded-full font-bold <?= ($utilisateur['statut'] === 'validé') ? 'status-pill-valid' : 'status-pill-pending' ?>">
            <?= strtoupper($utilisateur['statut']) ?>
        </span>
    </td>
    <td class="px-6 py-4 text-center space-x-2">
        <!-- NOUVEAU : Bouton Voir Profil -->
        <a href="Details.php?id=<?= $utilisateur['original_index'] ?>" class="text-slate-400 hover:text-emerald-600 transition-colors p-2 inline-block" title="Voir le profil">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        </a>
        
        <a href="modifier.php?id=<?= $utilisateur['original_index'] ?>" class="text-slate-400 hover:text-blue-600 transition-colors p-2 inline-block">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        </a>
        
        <a href="#popup<?= $utilisateur['original_index'] ?>" class="text-slate-400 hover:text-red-600 transition-colors p-2 inline-block">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </a>
    </td>
</tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="p-6 bg-slate-50/50 flex justify-center gap-2">
                    <?php if ($nombreDePages > 1): ?>
                        <?php for ($i = 1; $i <= $nombreDePages; $i++): ?>
                            <a href="?page=<?= $i ?>&q=<?= urlencode($recherche) ?>" 
                               class="w-10 h-10 flex items-center justify-center rounded-xl text-sm font-bold transition-all <?= ($i == $pageActuelle) ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-slate-500 border border-slate-100 hover:bg-blue-50' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- POPUP DE SUPPRESSION (Design Tailwind) -->
    <?php foreach ($etudiantsPage as $utilisateur): ?>
    <div id="popup<?= $utilisateur['original_index'] ?>" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm opacity-0 pointer-events-none target:opacity-100 target:pointer-events-auto transition-all">
        <div class="bg-white w-full max-w-sm rounded-[32px] p-8 shadow-2xl text-center">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-xl font-bold">Confirmer la suppression</h3>
            <p class="text-slate-500 text-sm mt-2 mb-8">Voulez-vous vraiment retirer <span class="text-slate-900 font-bold"><?= $utilisateur['nom'] ?></span> de la base de données ?</p>
            
            <div class="flex flex-col gap-3">
                <a href="supprimer.php?id=<?= $utilisateur['original_index'] ?>" class="w-full bg-red-600 text-white font-bold py-4 rounded-2xl hover:bg-red-700 transition-all">Oui, supprimer</a>
                <a href="#" class="w-full bg-slate-100 text-slate-500 font-bold py-4 rounded-2xl hover:bg-slate-200 transition-all">Annuler</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</body>
</html>