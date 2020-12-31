<?php
    session_start();
    require_once("fonctions/bdd.php");
    include_once("fonctions/blog.php");
    include_once("fonctions/membres.php");
    $bdd = bdd();
    if(!empty($_POST["commentaire"])){
        commenter();
    }
    $article = article_seul();
    $nb_commentaires = nb_commentaires();
    $commentaires = commentaires();
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Harmomila - Article</title>
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
<!--TITRE ET MENU-->
<?php
    include("header.php");
?>
<!--articles etc.-->
<div class="row">
    
    <main class="col-sm-8">
        <article class="main">
        <?php if($article){?>
            <h1><?= $article["titre"]?></h1>
            <date datetime=<?=$article["date"]?>>Le <?= datation($article["date"]) ?> </date>
            <img class="article" src="images/<?= $article["img"]?>" style="padding: 15px 15px 15px 15px;">
            <p class="article"><?= $article["contenu"]; ?></p>
        <?php }
            else{
        ?>
            <h1>L'article recherché n'existe plus, désolé...</h1>
        <?php }?>
        </article>
    </main>
    <?php include("aside.php");?>    
</div>
<br/>
<?php if($article): ?>
    <div class="commentaires">
        <h3>Commentaires (<?=$nb_commentaires?>)</h3>

        <?php
            foreach ($commentaires as $com) { 
        ?>
        <div class="com">
            <p class="utilisateur">Par <span style="font-weight: bold"><?=$com["pseudo"]?></span> le <date datetime=<?=$com["date"]?>><?=datation($com["date"])?></date></p>
            <hr color="grey" width="90%">
            <p style="white-space: pre;"><?=($com["commentaire"])?></p>
        </div>
        <?php
            }
        ?>
        <hr/>
        <?php
            if(isset($_SESSION["membre"])){
        ?>
        <h3>Vous pouvez aussi commenter: </h3>
        <form action="" method="POST">
            <textarea name="commentaire" id="com" rows="10" required></textarea> <br/>
            <div class="envoyer"><input type="submit" id="envoyer" name="envoyer" value="Envoyer"></div>
        </form>
        <?php
            }
            else{
        ?>       
        <h3>Vous devez être connecté(e) pour poster un commentaire</h3>
        <?php
        }
        ?>   
    </div>
<?php endif; ?>

    <?php include("footer.php");?>

    <script src="fonctions/misc.js" type="text/javascript"></script>
</body>
</html>