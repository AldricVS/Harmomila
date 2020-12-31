<?php
    session_start();
    require_once("fonctions/bdd.php");
    include_once("fonctions/blog.php");
    include_once("fonctions/membres.php");
    $bdd = bdd();
    if(!empty($_GET["requete"])){
        $articles = recherche();
        $en_recherche = true;
    }
    else{
        if(!isset($_GET["page"]))
            header("Location: index?page=1");
        $articles = articles();
        $id_lastpage = get_lastpage();
        $en_recherche = false;
    }
?>
<!--fin-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Harmomila</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Blog mila" content="C'est un blog tenu par une naturopathe, Emilia Silvestre, qui référence des astuces santé et des recettes sans sucre">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/redmond/jquery-ui.css" />
</head>
<body>
<!--TITRE ET MENU-->
<?php
    include("header.php");
?>
<!--articles etc.-->


<div class="wrap">
    <div class="search">
        <form method="GET" action="">
            <input type="text" name="requete" id="recherche" maxlength="70" placeholder="Recherche..." <?php if($en_recherche):?> value="<?=trim($_GET["requete"])?><?php endif;?>">
            <button type="submit" class="searchButton">OK</button>
        </form>
    </div>
    <br/>
    <?php
        if(!empty($en_recherche)){
    ?>
        <p class="resultats">Résultats pour la recherche: <span style="font-weight:bold;"><?=$_GET["requete"]?></span></p>
    <?php 
        }
    ?>
</div>


<div class="row">
        
    <main class="col-sm-8">
        <?php 
            if($articles != NULL){
            foreach ($articles as $a) {
        ?>
            <article>
            <img src="images/<?=$a["img"]?>" alt="image"/>
            <h2><a style="color: darkslateblue;" href="categories?page=1&cat=<?=$a["categorie"]?>"><?= get_categorie_nom($a["categorie"])?></a><h2>
            <h1> <?=$a["titre"]?> </h1>
            <date datetime=<?=$a["date"]?>>Le <?= datation($a["date"]) ?> </date>
            <p> <?= $a["description"] ?> </p>
            <a class="button" href="article?id=<?= $a["id"]?>" >Je lis la suite</a>
            </article>
        <?php
            }
        }
        ?>
        <?php 
        if(!$en_recherche){
        ?>
        <article>
        <?php
            if($_GET["page"] != 1){
        ?>
        <a class="button" href="index?page=1"><<</a>
        <a class="button" href="index?page=<?= $_GET["page"]-1?>"><</a>
        <?php 
            }
        ?>
        <p style="display: inline-block;">Page <?= $_GET["page"]?>/<?= $id_lastpage?></p>
        <?php
            if($_GET["page"] != $id_lastpage){
        ?>
        <a class="button" href="index?page=<?= $_GET["page"]+1?>">></a>
        <a class="button" href="index?page=<?= $id_lastpage?>">>></a>
        <?php 
            }
        ?>
        <?php
        }
        ?>
        </article>
    </main>

    <?php include("aside.php");?>

    <?php 
        include("footer.php");
    ?>
</div>

    <!-- inclusion des libraries jQuery et jQuery UI (fichier principal et plugins) -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#recherche').autocomplete({
                source : 'recherche.php'
            });
        });
    </script>

</body>
</html>