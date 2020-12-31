<?php
    session_start();
    require_once("fonctions/bdd.php");
    include_once("fonctions/contact_fonc.php");
	include_once("fonctions/membres.php");

	include_once("fonctions/imageHandler.php");
	
    $bdd = bdd();
    if(!empty($_POST))
		$envoye = contact();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Harmomila - Contact</title>
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
            <?php
                if(!empty($_POST))
                    if($envoye)
                        echo '<p class="message"> Votre message a bien été envoyé. Vous recevrez une réponse par mail le plus vite possible. <br/>
                        Merci Beaucoup!<br/></p>';
                    else 
                        echo '<p class="message">Une erreur est survenue lors de l\'envoi du message <br/> 
                        Veuillez contacter "aldric.vitali@outlook.fr"<br/>
                        ou mettre un commentaire sur l\'article le plus récent si le problème persiste.<br/>
                            Merci de votre compréhension.<br/> 
                            </p>';
            ?>
        
        <form action="" method="post" class="form">
            <div class="form-1 row">            
                <div class=" form col-md-4">
                    <label for="name">Nom: </label>
                    <input type="text" name="nom" id="nom" required>
                </div>
                <div class="form col-md-4">
                    <label for="email"> e-mail: </label>
                    <input type="email" name="mail" id="mail" required>
                </div>
                <div class="form col-md-4">
                    <label for="objet">Objet: </label>
                    <input type="text" name="objet" id="objet" required>
                </div>
            </div>
        
            <div class="form-1">
                <label for="msg">Votre message:</label>
                <textarea id="msg" name="msg" rows="30" required></textarea>
            </div>

            <div class="envoyer">
                <input type="submit" id="envoyer" name="envoyer" value="Envoyer">
            </div>

        </form>
    </main>


    <?php include("aside.php");?>
</div>

    <?php include("footer.php");?>
</body>
</html>