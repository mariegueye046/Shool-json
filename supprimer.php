<?php
session_start();


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $contenu = file_get_contents("data.json");
    $data = json_decode($contenu, true);

    if (isset($data[$id])) {
        
        if ($data[$id]['photo'] !== "images/defaut.png" && file_exists($data[$id]['photo'])) {
            unlink($data[$id]['photo']);
        }

        unset($data[$id]);

       
        $data = array_values($data);

        
        file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));
    }
}


header("Location: accueil_admin.php");
exit();
?>