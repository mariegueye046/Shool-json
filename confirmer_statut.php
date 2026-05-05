<?php
if (!isset($_GET['id'])) {
    header("Location: dashboard_admin.php");
    exit();
}
$id = (int) $_GET['id'];
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmer la suppression | Telly Tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-slate-900/40 flex items-center justify-center min-h-screen p-4">

    <!-- La boîte de dialogue (Modal) -->
    <div class="w-full max-w-md transform transition-all animate-in fade-in zoom-in duration-300">
        <div class="glass-effect bg-white rounded-[40px] shadow-2xl border border-white p-8 md:p-10 text-center">
            
            <!-- Icône d'alerte animée -->
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 ring-8 ring-red-50/50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>

            <!-- Texte de confirmation -->
            <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Supprimer l'étudiant ?</h3>
            <p class="text-slate-500 mt-3 mb-10 leading-relaxed text-sm">
                Cette action est <span class="font-bold text-red-600">irréversible</span>. Toutes les données associées à cet étudiant seront définitivement effacées du système.
            </p>

            <!-- Actions -->
            <div class="flex flex-col gap-3">
                <a href="supprimer.php?id=<?= $id ?>" 
                   class="w-full py-4 bg-red-600 text-white font-bold rounded-2xl hover:bg-red-700 shadow-lg shadow-red-200 transition-all transform active:scale-[0.98]">
                    Confirmer la suppression
                </a>
                
                <a href="accueil_admin.php" 
                   class="w-full py-4 bg-slate-100 text-slate-600 font-bold rounded-2xl hover:bg-slate-200 transition-all text-sm">
                    Non, je change d'avis
                </a>
            </div>

            <!-- Petit rappel discret -->
            <p class="mt-8 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                Identifiant ID: #<?= $id ?>
            </p>
        </div>
    </div>

</body>
</html>