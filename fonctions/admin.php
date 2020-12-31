<?php
   /**
	* Ajoute un article dans la base de données du site 
    * @return void
    */
    function poster(){
        global $bdd;
        extract($_POST);

        $valide = true;
        $err = [];

        if(!isset($_FILES["file"]) OR $_FILES["file"]["error"] > 0){
            $valide = false;
            $err[] = "Il faut indiquer une image valide";
        }

        if($valide){
            $img = basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], '../images/'. $img);

            $poster = $bdd->prepare("INSERT INTO articles(titre, description, contenu, categorie, img) VALUES(:titre, :desc, :contenu, :categorie, :img)");
            $poster->execute([
                "titre" => htmlentities($titre),
                "desc" => (htmlentities($desc)),
                "contenu" => nl2br($editor),
                "categorie" => $categorie,
                "img" => htmlentities($img)
            ]);

            unset($_POST["titre"]);
            unset($_POST["desc"]);
            unset($_POST["editor"]);
            unset($_POST["categorie"]);
            unset($_FILES["file"]);
        }

        return $err;
    }


   /**
	* Retourne tous les articles contenus dans la base de données
    * @return string[][] le tableau contenant tous les articles
    */
    function posts(){
        global $bdd;

        $posts = $bdd->query("SELECT id, titre, categorie FROM articles ORDER BY id DESC");
        $posts = $posts->fetchAll();

        return $posts;
    }


   /**
	* Retourne un article particulier, en fonction de son id (passé via $_GET)
    * @return string[] le tableau associatif dcontenant toutes les informations de l'article voulu
    */
    function post(){
        global $bdd;

        $id = (int)$_GET["id"];

        $r = $bdd->prepare("SELECT titre, description, contenu, categorie FROM articles WHERE id = ?");
        $r->execute([$id]);
        $r = $r->fetch();

        return $r;
	}
	
   /**
	* Modifie un article déjà stocké dans la base de données avec l'aide de $_POST
    * @return void
    */
    function modifier(){
        global $bdd;

        extract($_POST);
		$id = (int)$_GET["id"];

        $modifier = $bdd->prepare("UPDATE articles SET titre = :titre, description = :description, contenu = :article, categorie = :categorie WHERE id = :id");
        $modifier->execute([
            "titre" => htmlentities($titre),
            "description" => htmlentities($desc),
            "article" => nl2br($editor),
            "categorie" => $categorie,
            "id" => $id
        ]);

        unset($_POST["titre"]);
        unset($_POST["desc"]);
        unset($_POST["editor"]);
        unset($_POST["categorie"]);

        return false;

    }

	/**
	 * Modifie le contenu de la bulle de pensée avec l'aide de $_POST, en remettant à jour la date
	 */
    function modif_pensee(){
        global $bdd;

        extract($_POST);
        $mod = $bdd->prepare("UPDATE misc SET pensee_moment = :pensee, derniere_modif = :date");
        $mod->execute([
            "pensee" => htmlentities($contenu),
            "date" => date("d-m-Y")
            ]);

        return false;
    }

?>