<?php
    function connexion(){
        global $bdd;
        extract($_POST);

        $valide = true;
        $err = [];

        $connexion = $bdd->prepare("SELECT id, mdp FROM membres WHERE pseudo = ?");
        $connexion->execute([$identifiant_co]);
        $connexion = $connexion->fetch();

        if($connexion == NULL){
            $connexion = $bdd->prepare("SELECT id, mdp FROM membres WHERE email = ?");
            $connexion->execute([$identifiant_co]);
            $connexion = $connexion->fetch();

            if($connexion == NULL)
                return "Aucun membre n'a cet identifiant sur ce site.";  
        }

        if(password_verify($mdp_co, $connexion["mdp"])){
            $_SESSION["membre"] = $connexion["id"];
            header("Location: compte.php");
        }
        else {
            return "Le mot de passe est incorrect.";
        }
    }


    //inscription
    function inscription(){
        global $bdd;
        extract($_POST);

        $valide = true;
        $err = [];

        if(empty($pseudo_in) || empty($mail_in) || empty($mdp_in) || empty($mdp_bis_in)){
            $valide = false;
            $err[] = "Tous les champs doivent être remplis";
        }

        if(strlen($pseudo_in) <= 4 || ctype_space($pseudo_in)){
            $valide = false;
            $err[] = "Le pseudo est invalide, il doit être composé de 5 caractères minimum";
        }

        if(pseudo_existe($pseudo_in)){
            $valide = false;
            $err[] = "Le pseudo existe déjà, veuillez en trouver un autre."; 
        }

        if(mail_existe($mail_in)){
            $valide = false;
            $err[] = "L'adresse e-mail est déjà utilisée, il faut en trouver une autre.";
        }
        elseif(mail_invalide($mail_in)){
            $valide = false;
            $err[] = "L'adresse e-mail n'est pas valide, veuillez choisir une boite-mail non jetable.";
        }

        if($mdp_in != $mdp_bis_in){
            $valide = false;
            $err[] = "le mot de passe et le mot de passe de confirmation sont incorrects";
        }


        if ($valide) {
            $inscription = $bdd->prepare("INSERT INTO membres(pseudo, email, mdp) VALUES(:pseudo, :email, :mdp)");
            $inscription->execute([
                "pseudo" => htmlentities($pseudo_in),
                "email" => htmlentities($mail_in),
                "mdp" => password_hash($mdp_in, PASSWORD_DEFAULT)
            ]);

            unset($_POST["pseudo_in"]);
            unset($_POST["mail_in"]);
            unset($_POST["mdp_in"]);
            unset($_POST["mdp_bis_in"]);
        }

        return $err;
    }

    function pseudo_existe($nom){
        global $bdd;

        $resultat = $bdd->prepare("SELECT COUNT(*) FROM membres WHERE pseudo = ?");
        $resultat->execute([$nom]);
        $resultat = $resultat->fetch()[0];

        return $resultat;
    }

    function mail_existe($nom){
        global $bdd;

        $resultat = $bdd->prepare("SELECT COUNT(*) FROM membres WHERE email = ?");
        $resultat->execute([$nom]);
        $resultat = $resultat->fetch()[0];

        return $resultat;
    }

    function mail_invalide($mail){
        global $bdd;

        $m = explode("@", $mail)[1];
        $r = $bdd->prepare("SELECT COUNT(*) FROM email_disposable WHERE domain = ?");
        $r->execute([$m]);
        $r = $r->fetch()[0];

        return $r;
    }

    //deconnexion
    function deconnexion(){
        unset($_SESSION["membre"]);
        session_destroy();
        header("Location: creationOUconnexion");
    }

    //etc...
    function get_infos(){
        global $bdd;

        $r = $bdd->prepare("SELECT pseudo, email FROM membres WHERE id = ?");
        $r->execute([$_SESSION["membre"]]);
        $r = $r->fetch();

        return $r;
    }
?>