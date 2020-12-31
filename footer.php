<?php
        include_once("fonctions/blog.php");
        $modif = get_derniere_modif();
?>
<footer>
        <p>dernière mise à jour le <?= $modif?></p>
</footer>