<?php
    session_start();
    if(!isset($_SESSION["membre"]))
        header("Location: index.php");
    require_once("fonctions/bdd.php");
    include_once("fonctions/blog.php");
    include_once("fonctions/membres.php");
    $bdd = bdd();
    $infos = get_infos();
    $commentaires = commentaires_membre();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Harmomila - Compte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Blog mila" content="C'est un blog tenu par une naturopathe, Emilia Silvestre, qui référence des astuces santé et des recettes sans sucre">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include("header.php");
    ?>

    <div class="row">

    <main class="col-sm-8">

    
            <div class="presentation">
                <h1>Bienvenue <?= $infos[0] ?> !</h1>
                <p>Adresse e-mail : <?= $infos[1] ?></p>
            </div>

        <br/><br/>
        <div class="commentaires" >
        <?php
            if($commentaires == NULL){
        ?>
        <h1>Vous n'avez pas posté de commentaire</h1>
        <?php 
            }
            else{ ?>
        <h1>Derniers commentaires !</h1>
        <?php
                foreach($commentaires as $com){
        ?>
            
            <div class="com">
                <p class="utilisateur">Posté sur l'article "<a href='article?id=<?= $com["id_article"]?>'><?= $com["titre"] ?></a>" le <time datetime=<?= $com["date"]?>> <?= datation($com["date"])?></time> :</p>
                <hr/>
                <p><?= nl2br($com["commentaire"]) ?></p>
                <br/>
                <a class="button supprimer" href="supprimer?id_com=<?=$com["id"]?>" onclick="return confirm('êtes-vous sûr(e) de vouloir le supprimer?')">
                Supprimer le commentaire</a>

            </div>      
        <?php
                }
            }
        ?>
        </div>
        

    </main>


    <?php
    include("aside.php");
    ?>


    <?php
    include("footer.php");
    ?>
    </div>
    
</body>
</html>