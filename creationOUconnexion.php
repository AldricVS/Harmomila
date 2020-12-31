<?php
    session_start();
    if(isset($_SESSION["membre"]))
        header("Location: index.php");
    require_once("fonctions/bdd.php");
    include_once("fonctions/blog.php");
    include_once("fonctions/membres.php");
    $bdd = bdd();
    $erreurs_co = "";
    $erreurs_in = "";
    if (!empty($_GET["action"])) 
        switch ($_GET["action"]){
            case 'connexion':
                $erreurs_co = connexion();
                break;
        
            case 'inscription':
                $erreurs_in = inscription();
                break;

            default:
                break;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Harmomila - Création/Connexion</title>
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

<main class="log">
    <div class=row>
        <div class="part col-sm-5">
            <h2>Connectez-vous ici</h2><hr/>
            <form action="creationOUconnexion?action=connexion" method="POST" class="form-1">
                <label for="pseudo">Votre nom ou e-mail </label>
                <input type="text" name="identifiant_co" id="pseudo" maxlength="40" value="<?php if(isset($_POST["identifiant_co"])) echo $_POST["identifiant_co"];?>" required/><br/><br/>
                <label for="mdp">Votre mot de passe</label>
                <input type="password" name="mdp_co" id="mdp" maxlength="255" required/>
                <div class="envoyer"><input type="submit" name="envoyer" value="Connexion"></div>
            </form>
            <?php
            if (!empty($_GET["action"])) 
                if($_GET["action"] == "connexion"){
                    if($erreurs_co)
            ?>
                <p class="error_msg"><?=$erreurs_co?></p>   
            <?php 
                }
                else
                header("compte.php");
            ?>
        </div>
        <div class="part col-sm-7">
            <h2>Vous êtes nouveau/nouvelle?<br/>Créez votre compte maintenant!</h2><hr/>
            <form action="creationOUconnexion?action=inscription" method="POST" class="form-1">
                <table class="connexion">
                    <td>
                        <label for="pseudo">Votre nom </label>
                        <input type="text" name="pseudo_in" id="pseudo" maxlength="20" value="<?php if(isset($_POST["pseudo_in"])) echo $_POST["pseudo_in"];?>" required/>
                        <label for="mail">Votre mail </label>
                        <input type="email" name="mail_in" id="mail" maxlength="50" value="<?php if(isset($_POST["mail_in"])) echo $_POST["mail_in"];?>" required/>
                    </td>
                    <td>
                        <label for="mdp">Votre mot de passe</label>
                        <input type="password" name="mdp_in" id="mdp" maxlength="255" required/>
                        <label for="mdp-bis">Confirmez votre mot de passe</label>
                        <input type="password" name="mdp_bis_in" id="mdp-bis" maxlength="255" required/>
                    </td>
                </table>
                <div class="envoyer"><input type="submit" name="envoyer" value="Création"></div>
            </form>
            <?php
            if(!empty($_GET["action"]))
                if($_GET["action"] == "inscription"){
                    if($erreurs_in)
                        foreach($erreurs_in as $err){
            ?>
                <p class="error_msg"><?=$err?></p>   
            <?php 
                        }
                    else{
            ?>
                <p class="confirm_msg">Inscription complétée, bienvenue parmi nous.</p>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</main>

    <?php include("footer.php");
        $_GET["action"] = NULL;
    ?>
</div>

</body>
</html>