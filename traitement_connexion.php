<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $contenu = file_get_contents("data.json");
    $data = json_decode($contenu, true) ?? [];

    $utilisateur_trouve = null;


    foreach ($data as $utilisateur) {
        if ($utilisateur['email'] === $email && password_verify($password, $utilisateur['password'])) {
            $utilisateur_trouve = $utilisateur;
            break;
        }
    }

    if ($utilisateur_trouve) {
        
        if ($utilisateur_trouve['role'] === "etudiant" && $utilisateur_trouve['statut'] === "en_attente") {
            $_SESSION['error'] = "Votre compte est encore en attente de validation par l'admin.";
            header("Location: connexion.php");
            exit();
        }

        $_SESSION['utilisateur_trouve'] = $utilisateur_trouve;
        $_SESSION['role'] = $utilisateur_trouve['role'];

        if ($utilisateur_trouve['role'] === "admin") {
            header("Location: accueil_admin.php");
        } else {
            header("Location: accueil_etudiant.php");
        }
        exit();

    } else {
        $_SESSION['error'] = "Email ou mot de passe incorrect.";
        header("Location: connexion.php");
        exit();
    }

} else {
    header("Location: connexion.php");
    exit();
}
?>





 