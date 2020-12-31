<?php 
    function bdd(){
        try{
            $bdd = new PDO("db", "username", 'password');
        } catch (PDOException $e){
            echo 'Connexion au serveur échouée :' . $e->getMessage();
        }
        $bdd->exec("SET CHARACTER SET utf8");
        return $bdd;
    };
?>
