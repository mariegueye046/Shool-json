<?php
session_start();

// 1. Vérification de sécurité stricte
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: connexion.php"); // Rediriger plutôt que de "mourir" brutalement
    exit();
}

// 2. Vérification de la présence de l'ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $fichier = "data.json";

    if (file_exists($fichier)) {
        $contenu = file_get_contents($fichier);
        $data = json_decode($contenu, true) ?? [];

        // 3. On vérifie si l'utilisateur existe bien dans le tableau
        if (isset($data[$id])) {
            $data[$id]['statut'] = "validé";

            // Sauvegarde propre
            if (file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT))) {
                // Redirection avec un message de succès
                header("Location: accueil_admin.php?status=validated");
                exit();
            }
        }
    }
}

// En cas d'erreur ou d'ID manquant, on repart simplement
header("Location: accueil_admin.php");
exit();
?>