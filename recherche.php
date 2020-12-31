<?php
    require_once("fonctions/bdd.php");
    $bdd = bdd();

    $term = $_GET["term"];

    $r = $bdd->prepare("SELECT * FROM articles WHERE titre LIKE ? order by id desc");
    $r->execute(['%'.$term.'%']);

    $array = [];
    $i = 0 ; 
    while($donnee = $r->fetch() AND $i < 5 ) // on effectue une boucle pour obtenir les données
    {
        array_push($array, html_entity_decode($donnee['titre'])); // et on ajoute celles-ci à notre tableau
        $i++;
    }

    echo json_encode($array);

?>
