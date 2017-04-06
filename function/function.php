<?php

function bdd(){
    try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=localhost;dbname=forumdb','root','',$pdo_options);
    }
    catch(Exeption $e){
        die('Erreur : ' . $e->getMessage());
    }
    return $bdd;
    
}
?>