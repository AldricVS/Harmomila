<?php
    require_once("../fonctions/bdd.php");
    include_once("../fonctions/blog.php");
    include_once("../fonctions/admin.php");
    $bdd = bdd();
    if(isset($_POST["editor"])){
        $erreurs = poster();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Harmomila</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="C'est un blog tenu par une naturopathe, Emilia Silvestre, qui référence des astuces santé et des recettes sans sucre">
	<meta name="robots" content="noindex"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../style.css">
	<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>
<body>

    <?php include("header_admin.php")?><br/>

        <div class="form_post">
            <?php
            if(isset($erreurs)):
                if(!empty($erreurs)):
                    foreach($erreurs as $err):
            ?>
                <p class="error_msg"><?=$err?></p>   
            <?php 
                    endforeach;
                else:
            ?>
                <p class="confirm_msg">L'article a été posté.</p>
            <?php
                endif;
            endif;
            ?>

            <h1>Poster un article</h1><br/><br/>

            <form action="" enctype="multipart/form-data" method="POST" class="form_post" enctype="multipart/form-data" >
                <input type="file" name="file" id="fichier" placeholder="image" required/><br/>
                <label for="select" class="custom_select">
                    <select class="cat-dropdown" name="categorie" required>
                        <option value="">Selectionnez une catégorie</option>
                        <option value="1">Bien-être</option>
                        <option value="2">Divers</option>
                        <option value="3">Petites astuces</option>
                        <option value="4">Recettes sucrées</option>
                        <option value="5">Recettes salées</option>
                    </select>
                </label>
                
                <input type="text" name="titre" maxlength="60" placeholder="Titre de l'article" value="<?php if(isset($_POST["titre"])) echo $_POST["titre"]?>" required/><br/>
                <input type="text" name="desc" maxlength="255" rows="20" placeholder="Description de l'article" value="<?php if(isset($_POST["desc"])) echo $_POST["desc"]?>" required/><br/>
				<textarea name="editor"></textarea>

				<input type="button" class="envoyer" value="prévisualisation de l'article" onclick="preview()"/>
                <main><article id="preview"></article></main>
                <input type="submit" value="Poster !" onclick="return confirm('Voulez-vous vraiment poster l\'article?')"/>
            </form>   
        </div>
		<script src="../fonctions/editor.js" type="text/javascript"></script>
</body>
</html>