<?php
session_start();

$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$adress = $_POST['adress'] ?? '';
$role = $_POST['role'] ?? 'etudiant';

if (empty($nom) || empty($email) || empty($password) || empty($adress)) {
    die("Tous les champs sont obligatoires");
}

/* Chargement JSON */
$data = json_decode(file_get_contents("data.json"), true) ?? [];

/* Vérifier email */
foreach ($data as $u) {
    if (isset($u['email']) && $u['email'] === $email) {
        die("Cet email existe déjà");
    }
}

/* Upload photo */
if (!empty($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
    $destination = "images/" . time() . "_" . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], $destination);
} else {
    $destination = "images/default.jpg";
}

/* Mot de passe */
$passwordHache = password_hash($password, PASSWORD_DEFAULT);

/* ID auto-incrément */
$nouvelId = 1;
$ids = [];

foreach ($data as $u) {
    if (isset($u['id'])) {
        $ids[] = $u['id'];
    }
}

if (!empty($ids)) {
    $nouvelId = max($ids) + 1;
}


$nouvelUtilisateur = [
    "id" => $nouvelId,
    "photo" => $destination,
    "nom" => $nom,
    "email" => $email,
    "password" => $passwordHache,
    "adress" => $adress,
    "role" => $role,
    "statut" => ($role === "admin") ? "validé" : "en_attente"
];
if($role === "etudiant"){
   $nouvelUtilisateur = [
     "id" => $nouvelId ,
     "photo" => $destination, 
     "nom" => $nom,
      "email" => $email,
       "password" => $passwordHache,
        "adress" => $adress,
         "role" => "etudiant",
          "statut" => "en_attente",
           "photo" => $destination 
           ];
            $message = "Votre demande a bien été enregistrée. Veuillez attendre la validation de l’administrateur.";
             } else { 
              $nouvelUtilisateur = [
                 "id" => $nouvelId,
                  "photo" => $destination, 
                  "nom" => $nom, 
                  "email" => $email,
                   "password" => $passwordHache, 
                   "adress" => $adress,
                    "role" => "admin",
                     "statut" => "validé",
                      "photo" => $destination ];
                       $message = "Inscription administrateur réussie !"; }

$data[] = $nouvelUtilisateur;

file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));

header("Location: connexion.php");
exit();




















