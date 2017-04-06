<?php 
    session_start(); 
    include_once 'function/function.php';
    include_once 'function/addSujet.class.php';
    $bdd = bdd();

    if (isset($_POST['nomSujet']) AND isset($_POST['sujetContent'])){
        
        $addSujet = new addSujet($_POST['nomSujet'],$_POST['sujetContent'],$_POST['categorie']);
        $verif = $addSujet->verif();
        if ($verif == "ok"){
            $addSujet->insert();
            header('Location: index.php?nomSujet='.$_POST['nomSujet']);
          
        }
        else{//si erreur
            $erreur=$verif;
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

<body class="grey">      
    <main>
        <div class="banner">
            <h1 class="banner-text" style="padding-top:30px;">Bienvenue sur Forum-app</h1><br>
        </div> 
        <div class="cforum">
            <div class="inner-banner">
                <h3 class="inner-banner">Ajout d'un sujet : </h3>
            </div>
            <br>
            <?php   
                echo 'Bienvenue '.$_SESSION['pseudo'].'. <a href="deconnexion.php">Déconnexion</a>'; 
            ?>
            
            <form method="post" action="addSujet.php?categorie=<?php echo $_GET['categorie'] ?>">
                <p>
                    <input type="text" name="nomSujet" placeholder="Nom du nouveau sujet..." required/><br>
                    <textarea name="sujetContent" placeholder="Contennu du sujet"></textarea><br>
                    <input type="hidden" name="categorie" value="<?php echo $_GET['categorie'] ?>"/>
                    <input type="submit" value="Ajouter le sujet"/>
                    <?php 

                        if (isset($erreur)){
                            echo $erreur;
                        }

                    ?>
                </p>    
            </form>
        </div>
</main> 
</body> 
</html>
