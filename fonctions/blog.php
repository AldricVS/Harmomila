<?php 
    //articles de l'accueil (et de la page "categories")
    function articles($categorie=NULL){
        global $bdd;
        $page = (int)$_GET["page"];

        if($categorie == NULL){
            $articles = $bdd->query("SELECT id, titre, categorie, description, date, img FROM articles ORDER BY id DESC");
            $articles = $articles->fetchAll();
        }
        else{
            $categorie = (int)$categorie;
            $articles = $bdd->prepare("SELECT id, titre, categorie, description, date, img FROM articles WHERE categorie = ? ORDER BY id DESC");
            $articles->execute([$categorie]);
            $articles = $articles->fetchAll();
        }

        $page_pas = $page == 1 ? 0 : ($page-1)*5;

        $articles_part = array_slice($articles, $page_pas, /*TAILLE DU TABLEAU VOULU*/ 5);

        if($articles_part == NULL)
            header("Location: index?page=1");

        return $articles_part;
    }

    function get_lastpage($categorie=NULL){
        global $bdd;
        if($categorie == NULL)
            $nb = $bdd->query("SELECT COUNT(*) FROM articles");
        else{
            $nb = $bdd->prepare("SELECT COUNT(*) FROM articles WHERE categorie = ?");
            $nb->execute([$categorie]);
        }
        $nb = $nb->fetch()[0];
        return intdiv($nb,5)+1;
    }

    function get_categorie_nom($categorie){
        return array("","Bien-être","Divers","Petites astuces","Recettes sucrées","Recettes salées")[$categorie];
    }

    function tri_result($sortArr, $sortKey){
        $data = [];
        $arr = [];
        foreach($sortArr as $key => $value){
            $k = '_'.$key;
            $data[$k] = $value;
            $array[$k] = $value[$sortKey];
        }

        array_multisort($array, SORT_DESC, $data);

        $sortArr = [];

        foreach($data as $key => $value){
            $sortArr[ltrim($key,"_")] = $value;
        }
        return $sortArr;
    }



    //recherche d'article
    function recherche(){
        global $bdd;
        $requete = $_GET["requete"];
        $requete = trim($requete);
        

        $liaisons = ["les ","la ","le ","des ","de ","l'","une ","uns ","un "," les"," la"," le"," des"," de"," l'"," une"," uns"," un","-",",","_",".","=","+","(",")","<script","</script>"];

        $requete = htmlentities($requete);
        $requete = strtolower($requete);
        $requete = str_replace($liaisons, "", $requete); //enleve articles, tirets, virgules etc.
        $requete = explode(" ",$requete);
        $requete = array_filter($requete);

        //var_dump($requete);

        $resultat = [];
        foreach($requete as $r){
            $recherche = $bdd->prepare("SELECT * FROM articles WHERE lower(titre) LIKE :requete OR lower(contenu) LIKE :requete or lower(description) LIKE :requete ORDER BY id DESC");
            $recherche->execute(["requete" => '%'.$r.'%']);
            $resultat = array_merge($resultat, $recherche->fetchAll());
        }
        $resultat = array_map("unserialize", array_unique(array_map("serialize", $resultat)));
        array_splice($resultat,0,0); //reindexe le tableau


        if(empty($resultat))
            return NULL;
        

        for($i = 0; $i <= max(array_keys($resultat)); $i++) {
            $resultat[$i]["points"] = 0;
            foreach($requete as $requ){
                if(strpos(strtolower($resultat[$i]["titre"]), $requ) !== false){
                    $resultat[$i]["points"] += 3;
                }
                if(strpos(strtolower($resultat[$i]["description"]), $requ) !== false){
                    $resultat[$i]["points"] += 2;
                }
                if(strpos(strtolower($resultat[$i]["contenu"]), $requ) !== false){
                    $resultat[$i]["points"] += 1;
                }
            }

        }
        $resultat = tri_result($resultat, 'points');
        $resultat = array_values($resultat);


        return $resultat;
    }

    


    //article unique
    function article_seul(){
        global $bdd;

        $id = (int)$_GET["id"];

        $article = $bdd->prepare("SELECT id, titre, contenu, categorie, date, img FROM articles WHERE id=:id");
        $article->execute(['id' => $id]);
        $article = $article->fetch();
        
        if($article == NULL)
            return false;

        return $article;
    }
    //date et heure jolies
    function datation($publication){
        $mois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

        $publication = explode(" ", $publication);
        $date = explode("-", $publication[0]);
        $heure = explode(":", $publication[1]);
        $date[1] = $mois[(int)$date[1]-1];

        $resultat = $date[2] . ' ' . $date[1] . ' ' . $date[0] . ' à ' . $heure[0] . 'h' . $heure[1];
        return $resultat;
    }


    //commentaires
    function nb_commentaires(){
        global $bdd;
        $id_article = (int)$_GET["id"];;

        $nb_commntaires = $bdd->prepare("SELECT COUNT(*) FROM commentaires WHERE id_article=:id_article");
        $nb_commntaires->execute(["id_article" => $id_article]);
        $nb_commntaires = $nb_commntaires->fetch()[0];

        return $nb_commntaires;
    }

    function commentaires(){
        global $bdd;
        $id_article = (int)$_GET["id"];

        $commentaires = $bdd->prepare("SELECT commentaires.*, membres.pseudo FROM commentaires INNER JOIN membres ON commentaires.id_membre = membres.id AND commentaires.id_article =:id_article ORDER BY id DESC");
        $commentaires->execute(["id_article" => $id_article]);
        $commentaires = $commentaires->fetchAll();

        return $commentaires;
    }

    function commentaires_membre(){
        global $bdd;
        $coms = $bdd->prepare("SELECT commentaires.*, articles.titre FROM commentaires INNER JOIN articles ON commentaires.id_article = articles.id AND commentaires.id_membre = ? ORDER BY id DESC");
        $coms->execute([$_SESSION["membre"]]);
        $coms = $coms->fetchAll();

        return $coms;

    }

    function commenter(){
        if (isset($_SESSION["membre"])) {
            global $bdd;

            if(isset($_GET["id"])){
            $id_article = (int)$_GET["id"];
            
            extract($_POST);

            $com = $bdd->prepare("INSERT INTO commentaires(id_membre, id_article, commentaire) VALUES(:id_m, :id_a, :com)");
            $com->execute([
                "id_m" => $_SESSION["membre"],
                "id_a" => $id_article,
                "com" => nl2br(htmlentities($commentaire))
            ]);

            header("Location: article?id=".$id_article);
            }
        }

    }

    //récupère juste l'id de l'article du moment
    function get_id_article_moment(){
        global $bdd;

        $r = $bdd->query("SELECT id_article_mom FROM misc");
        $r = $r->fetch()[0];
        return $r;
    }

    //récupère le titre et la description de l'article du moment
    function get_desc_article_moment($id){
        global $bdd;

        $r = $bdd->prepare("SELECT titre, description FROM articles WHERE id = ?");
        $r->execute([$id]);
        $r = $r->fetch();
        return $r;
    }

    function get_pensee(){
        global $bdd;

        $r = $bdd->query("SELECT pensee_moment FROM misc");
        $r = $r->fetch()[0];
        return $r;
    }

    function get_derniere_modif(){
        global $bdd;

        $r = $bdd->query("SELECT derniere_modif FROM misc");
        $r = $r->fetch()[0];
        return $r;
    }


?>