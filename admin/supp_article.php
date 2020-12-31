<?php
    require_once("../fonctions/bdd.php");
    $bdd = bdd();

    $id = (int)$_GET["id"];

    //recup nom image
    $img = $bdd->prepare("SELECT img FROM articles WHERE id = ?");
    $img->execute([$id]);
    $img = $img->fetch()["img"];

    //check si l'image est utilisée sur un autre article, la supprime si ce n'est pas le cas
    $check = $bdd->prepare("SELECT COUNT(*) FROM articles WHERE img = ?");
    $check->execute([$img]);
	$check = $check->fetch()[0];
	
	echo $check;

    if($check == 1){
        unlink("../images/".$img);
    }

    $suppr = $bdd->prepare("DELETE FROM articles WHERE id = ?");
    $suppr->execute([$id]);


    header("Location: posts.php");
?>