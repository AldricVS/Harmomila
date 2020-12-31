<?php
    require_once("../fonctions/bdd.php");
    include_once("../fonctions/blog.php");
    include_once("../fonctions/admin.php");
    $bdd = bdd();
    
    $art_mom = get_id_article_moment();
    $posts = posts();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Harmomila</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Blog mila" content="C'est un blog tenu par une naturopathe, Emilia Silvestre, qui référence des astuces santé et des recettes sans sucre">
	<meta name="robots" content="noindex"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include("header_admin.php")?>
<main class="form_posts">
    <?php
        foreach ($posts as $p){
    ?>
    <article>
        <h1><?= $p["titre"]?> ( <?= get_categorie_nom($p["categorie"])?> ) </h1> <br/>
        <a class="button" href="modifier.php?id=<?= $p["id"]?>">Modifier</a>
        <?php if($p["id"] != $art_mom){?>
        <a class="button" href="article_moment.php?id=<?= $p["id"]?>">Nouvel article du moment</a>
        <?php }?>
        <a class="button" href="supp_article.php?id=<?= $p["id"]?>" onclick="return confirm('êtes-vous sûr(e) de vouloir supprimer cet article?')">Supprimer</a>

    </article>
    <?php 
        }
    ?>
</main>

</body>