<?php session_start(); 
include_once 'function/function.php';
include_once 'function/inscription.class.php';
$bdd = bdd();


if (isset($_POST['pseudo'])AND isset($_POST['mail'])AND isset($_POST['password'])AND isset($_POST['Cpassword'])){
    $inscription = new inscription($_POST['pseudo'],$_POST['mail'],$_POST['password'],$_POST['Cpassword']);
    
    $test = $inscription->verif();
    
    if ($test == 'ok'){
        
        $inscription->enregistrement();
        $inscription->session();
        header('Location: index.php');
        
        
     }
    else{
       echo 'untrucfaux '.$test; 
    }

}
?> 
<!Doctype html>

<html>
    
<head>
    <meta charset="utf-8">
    <title>Forum app</title>
            
        <!--Import de Google Font-->     
        
        <link href='https://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
        
        <!--Surcharge de mon style Css -->
        <link type="text/css" rel="stylesheet" href="css/Style.css"/>


</head>

<body>      
<main>
    <div class="banner">
        <h1 class="banner-text" style="padding-top:30px;">Forum-app</h1><br>
    </div>
    <div class="cforum">
        <div class="inner-banner"><h3 class="inner-banner">Inscription</h3></div>
        <p>Pour avoir accès au forum vous devez vous inscrire, ou vous connecter <a href="connexion.php">ici.</a></p>
            <form method="post" action="inscription.php">
                 <p>   
                    <input name="pseudo" type="text" placeholder="pseudo" required /><br>
                    <input name="mail" type="text" placeholder="email" required /><br>
                    <input name="password" type="password" placeholder="Mot de passe" required /><br>
                    <input name="Cpassword" type="password" placeholder="Confirmation" required /><br><br>
                    <input type="submit" value="s'inscrire ! " class="btn">
                    <?php
                       if ($test =!'ok'){
                            echo $test;
                        }
                    ?>
                </p>
            </form>
    </div>
</main> 
</body> 
</html>



