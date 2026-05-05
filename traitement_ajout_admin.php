<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") { exit(); }


$nom = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['password'];
$adress = $_POST['adress'];


$nomPhoto = $_FILES['photo']['name'];
$destination = "uploads/" . time() . "_" . $nomPhoto;
move_uploaded_file($_FILES['photo']['tmp_name'], $destination);


$contenu = file_get_contents("data.json");
$data = json_decode($contenu, true) ?? [];


$passwordHache = password_hash($password, PASSWORD_DEFAULT);


$nouvelUtilisateur = [
    "nom" => $nom,
    "email" => $email,
    "password" => $passwordHache,
    "adress" => $adress,
    "role" => "etudiant",
    "statut" => "validé",
    "photo" => $destination
];


$data[] = $nouvelUtilisateur;
$json = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents("data.json", $json);

header("Location: accueil_admin.php?message=ajoute");
exit();