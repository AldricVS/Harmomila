<?php
    session_start();
    if(!isset($_SESSION["membre"]))
        header("Location: index.php");

    require_once("fonctions/bdd.php");
    $bdd = bdd();

    //check si le commentaire appartient à l'utilisateur
    $check = $bdd->prepare("SELECT id_membre FROM commentaires WHERE id = ?");
    $check->execute([$_GET["id_com"]]);
    $check = $check->fetch()[0];
    if($check != $_GET["id_com"])
        header("Location: index.php");
    
    //supprime le commentaire
    if(isset($_GET["id_com"])){
        $r = $bdd->prepare("DELETE FROM commentaires WHERE id = ?");
        $r->execute([$_GET["id_com"]]);
    }

    //retourne à la page de compte
    header("Location: compte.php");

?>