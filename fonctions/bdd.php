<?php 
    function bdd(){
        try{
            $bdd = new PDO("mysql:dbname=harmomila_blog;host=mysql-harmomila.alwaysdata.net", "harmomila", 'fgh214#aqer');
        } catch (PDOException $e){
            echo 'Connexion au serveur échouée :' . $e->getMessage();
        }
        $bdd->exec("SET CHARACTER SET utf8");
        return $bdd;
    };
?>