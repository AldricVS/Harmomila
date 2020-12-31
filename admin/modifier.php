<?php
    require_once("../fonctions/bdd.php");
    include_once("../fonctions/blog.php");
    include_once("../fonctions/admin.php");
    $bdd = bdd();
    if(isset($_POST))
        $erreurs = modifier();

    $post = post();
    
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
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

</head>
<body>

    <?php include("header_admin.php")?><br/>

        <div class="form_post">
        <?php
            if(isset($erreurs)):
                if($erreurs):
                    foreach($erreurs as $err):
            ?>
                <p class="error_msg"><?=$err?></p>   
            <?php 
                    endforeach;
                else:
            ?>
                <p class="confirm_msg">L'article a été modifié.</p>
            <?php
                endif;
            endif;
            ?>

            <h1>Modifier un article</h1><br/><br/>

            <form action="" method="POST" class="form_post" enctype="multipart/form-data">
                <label for="select" class="custom_select">
                    <select class="cat-dropdown" name="categorie" required>
                        <option value="1" <?php if($post["categorie"] == 1) echo 'selected'?>>Bien-être</option>
                        <option value="2" <?php if($post["categorie"] == 2) echo 'selected'?>>Divers</option>
                        <option value="3" <?php if($post["categorie"] == 3) echo 'selected'?>>Petites astuces</option>
                        <option value="4" <?php if($post["categorie"] == 4) echo 'selected'?>>Recettes sucrées</option>
                        <option value="5" <?php if($post["categorie"] == 5) echo 'selected'?>>Recettes salées</option>
                    </select>
                </label>
                <input type="text" name="titre" maxlength="60" placeholder="Titre de l'article" 
                value="<?php if(isset($_POST["titre"])) echo $_POST["titre"]; else echo $post["titre"]; ?>" required/><br/>
                
                <input type="text" name="desc" maxlength="255" rows="20" placeholder="Description de l'article"
                 value="<?php if(isset($_POST["desc"])) echo $_POST["desc"]; else echo $post["description"];?>" required/><br/>
                
                <textarea id="editor" name="editor">
				<?= str_replace("<br />","",$post["contenu"]) ?>
				</textarea>
                <input type="button" class="envoyer" value="prévisualisation" onclick="preview()"/>
                <main><article id="preview"></article></main>
                
                <input type="submit" value="Modifier !" onclick="return confirm('Voulez-vous vraiment modifier l\'article?')"/>
            </form>
            

        </div>
        <script src="../fonctions/editor.js" type="text/javascript"></script>
</body>
</html>