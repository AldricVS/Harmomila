<?php
    require_once("../fonctions/bdd.php");
    $bdd = bdd();

    $id = (int)$_GET["id"];

    $mod = $bdd->prepare("UPDATE misc SET id_article_mom = :id");
    $mod->execute(["id" => $id]);

    header("Location: posts.php");
?>