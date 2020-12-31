<?php
    require_once("../fonctions/bdd.php");
    include_once("../fonctions/blog.php");
    include_once("../fonctions/admin.php");
    $bdd = bdd();
    if(!empty($_POST))
        $erreurs = modif_pensee();

    $pensee = get_pensee();
    
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
                <p class="confirm_msg">La pensée a été modifiée.</p>
            <?php
                endif;
            endif;
            ?>

            <h1>Modifier la pensée du moment</h1><br/><br/>

            <form action="" method="POST" class="form_post">
                <textarea name="contenu" rows="30" placeholder="Pensée du moment" style="text-align: center;" required><?= str_replace("<br />","",$pensee) ?></textarea>
                
                <input type="submit" value="Modifier !" onclick="return confirm('Voulez-vous vraiment modifier la pensée du moment?')"/>
            </form>
            

        </div>
    
</body>