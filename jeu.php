<?php
session_start();

// Sécurité : seul l'admin peut accéder
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: connexion.php");
    exit();
}

// Récupérer l'ID de l'étudiant depuis l'URL
if (!isset($_GET['id'])) {
    header("Location: dashboard_admin.php"); // Redirection si aucun ID
    exit();
}

$id = (int)$_GET['id'];

// Charger les données
$contenu = file_get_contents("data.json");
$data = json_decode($contenu, true) ?? [];

// Vérifier que l'étudiant existe
if (!isset($data[$id]) || $data[$id]['role'] !== "etudiant") {
    echo "Étudiant non trouvé.";
    exit();
}

$etudiant = $data[$id];

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs envoyées
    $etudiant['nom'] = $_POST['nom'] ?? $etudiant['nom'];
    $etudiant['email'] = $_POST['email'] ?? $etudiant['email'];
    $etudiant['statut'] = $_POST['statut'] ?? $etudiant['statut'];

    // Mettre à jour le tableau principal
    $data[$id] = $etudiant;

    // Sauvegarder dans le fichier JSON
    file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));

    // Retour au dashboard
    header("Location: dashboard_admin.php");
    exit();
}
?>


