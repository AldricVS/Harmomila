<?php
    require_once("fonctions/bdd.php");
    include_once("fonctions/blog.php");
    include_once("fonctions/membres.php");
    $bdd = bdd(); 
    $id_art_mom = get_id_article_moment();
    $article_mom = get_desc_article_moment($id_art_mom);
    $pensee = get_pensee();
?>
<aside class="col-sm-4">
    <article>
        <h2>Article en avant:</h2>
        <h3><?= $article_mom["titre"]?></h3>
        <p><?= $article_mom["description"]?></p>
        <a class="button" href="article?id=<?= $id_art_mom?>">Aller voir ça</a>
    </article>
    <article>
        <h2>La pensée du moment</h2>
        <p><?= nl2br($pensee)?></p>
    </article>
    <section>
        <h2>Me contacter:</h2>
        <nav>
            <ul>    
                <li><a href="" style="color: blue;">Ma page Facebook <i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
                <li><p>Mon mail: Harmomilinhã@outlook.fr</p></li>
                <li><p>Mon numéro de téléphone: 07 82 59 66 92</p></li>
            </ul>
        </nav>
    </section>
</aside>