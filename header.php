<?php
    require_once("fonctions/bdd.php");
    include_once("fonctions/blog.php");
    include_once("fonctions/membres.php");
?>
<header>
    <div class="row">
        <div class="col-sm-3">
            <h1><a href="index">Harmomila</a></h1>
            <h2>Sans sucres et sans reproches! </h2>
        </div>
        <nav class="col-sm-9">
            <ul>
                <li><a href="index">Accueil</a></li>
                <li><a href="contact">Envoyer un message</a></li>
                <li><a href="categories">Catégories</a></li>
                <?php
                    if(isset($_SESSION["membre"])){
                ?>
                    <li><a href="compte"><?php echo(get_infos()[0])?></a></li>
                <?php
                    }
                    else{
                ?>
                    <li><a href="creationOUconnexion">Connexion/Inscription</a></li>

                <?php
                    }
                ?>

                <?php
                    if(isset($_SESSION["membre"])){
                ?>
                    <li><a href="deconnexion">Decconexion</a></li>
                <?php
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>