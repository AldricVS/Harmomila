<?php
    session_start();
    if(!empty($_POST["cat"]))
        if(empty($_GET["page"]))
            header("Location: categories?page=1&cat=".$_POST['cat']);
        else
            header("Location: categories?page=".$_GET["page"]."&cat=".$_POST['cat']);

    require_once("fonctions/bdd.php");
    include_once("fonctions/blog.php");
    $bdd = bdd();
    if(!empty($_GET["cat"])){
        $articles = articles($_GET["cat"]);
        $id_lastpage = get_lastpage($_GET["cat"]);
    }
?>
<!--fin-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Harmomila - Catégories</title>
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

<div class="row">
        
    <main class="col-sm-8">
        <form method="POST">
            <label for="select" class="custom_select">
                <select class="cat-dropdown" name="cat" onchange=" this.form.submit();" required>
                <option value="">Selectionnez une catégorie</option>
                <option value="1" <?php if(!empty($_GET["cat"]) && $_GET["cat"] == 1) echo 'selected'?>>Bien-être</option>
                <option value="2" <?php if(!empty($_GET["cat"]) && $_GET["cat"] == 2) echo 'selected'?>>Divers</option>
                <option value="3" <?php if(!empty($_GET["cat"]) && $_GET["cat"] == 3) echo 'selected'?>>Petites astuces</option>
                <option value="4" <?php if(!empty($_GET["cat"]) && $_GET["cat"] == 4) echo 'selected'?>>Recettes sucrées</option>
                <option value="5" <?php if(!empty($_GET["cat"]) && $_GET["cat"] == 5) echo 'selected'?>>Recettes salées</option>
                </select>
            </label>
        </form>
        <?php 
        if(isset($articles)){
            foreach ($articles as $a) {
        ?>
            <article>
            <img src="images/<?=$a["img"]?>" alt="image"/>
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
        if(!empty($_GET["page"])){
        ?>
        <article>
        <?php
            if($_GET["page"] != 1){
        ?>
        <a class="button" href="categories?page=1&cat=<?= $_GET["cat"]?>"><<</a>
        <a class="button" href="categories?page=<?= $_GET["page"]-1?>&cat=<?= $_GET["cat"]?>"><</a>
        <?php 
            }
        ?>
        <p style="display: inline-block;">Page <?= $_GET["page"]?>/<?=$id_lastpage?></p>
        <?php
            if($_GET["page"] != $id_lastpage){
        ?>
        <a class="button" href="categories?page=<?= $_GET["page"]+1?>&cat=<?= $_GET["cat"]?>">></a>
        <a class="button" href="categories?page=<?= $id_lastpage?>&cat=<?= $_GET["cat"]?>">>></a>
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

</body>
</html>