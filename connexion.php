<?php 
    session_start(); 
    include_once 'function/function.php';
    include_once 'function/connexion.class.php';
    $bdd = bdd();

    if (isset($_POST['pseudo'])AND isset($_POST['password'])){
        
        $connexion = new connexion($_POST['pseudo'],$_POST['password']);
        $verif = $connexion->verif();
        if ($verif=='ok')
        {
            if($connexion->session()){
                header('Location: index.php');
            }
        }
        else
            $erreur=$verif;
        
        
    }


?> 

<!Doctype html>

<html>
    
<head>
    <meta charset="utf-8">
    <title>Forum app</title>
    <!--Import Google Font-->     
        <link href='https://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
    
    <!--Surcharge de mon style Css -->
    <link type="text/css" rel="stylesheet" href="css/Style.css"/>

</head>

<body>      
<main>
    <div class="banner">
        <h1 class="banner-text" style="padding-top:30px">Forum-app</h1>
    </div>
    <div class="nav">
        <a href="#" onClick="history.back()" class="btn">Retour à l'inscription.</a>
    </div>
        <div class="cforum">
            <div class="inner-banner"><h3 class="inner-banner">connexion</h3></div>
            <form method="post" action="connexion.php">
            <p>   
                <input name="pseudo" type="text" placeholder="pseudo" required /><br>
                <input name="password" type="password" placeholder="Mot de passe" required /><br><br>
                   <?php
                if (isset($erreur)){  
                echo $erreur;}
                ?>
                <input type="submit" value="connexion" class="btn">
             
                </p>
            </form>
            
        </div>
</main> 
</body> 
</html>
