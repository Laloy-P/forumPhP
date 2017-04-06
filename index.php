<?php 
    session_start(); 
    include_once 'function/function.php';
    include_once 'function/addPost.class.php';
    $bdd = bdd();
    
    if (!isset($_SESSION['id'])){
        header('Location: inscription.php');
        
    }
    else {
        if (isset($_POST['nomSujet']) AND isset($_POST['sujetContent'])){
        
        $addPost = new addPost($_POST['nomSujet'],$_POST['sujetContent']);
        $verif = $addPost->verif();
            if ($verif == "ok"){
                $addPost->insert();


            }
            else{//si erreur
                $erreur=$verif;
            }
        }   
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
        <h1 class="banner-text" style="padding-top:30px;">Bienvenue sur le Forum</h1><br>
    </div> 
    <div class="nav">
        <a href="deconnexion.php" class="btn">Déconnexion</a>
        <a href="#" onClick="history.back()" class="btn">Page précedente </a>
    </div>
    <div class="cforum">
        <div class="banner-head" style="border-bottom: 1px solid #E5E5E5;border-bottom-width : 80%;">
           <?php echo 'Bienvenue '.$_SESSION['pseudo'].'. '; ?>
        </div>
            <?php
                if (isset($_GET['categories'])){//dans une catégorie
                    $_GET['categories'] = htmlspecialchars($_GET['categories']);
                   
                        ?> <div class="categorie-titre">
                        <h1> <?php echo $_GET['categories'];?></h1>
                        </div> 
                        <a href="addSujet.php?categorie=<?php echo $_GET['categories'] ?>"class="btn poz">Ajouter un sujet</a>
                        <?php 
                        
                        $requete = $bdd->prepare('SELECT * FROM sujet WHERE categorie = :categorie');
                        $requete->execute(array('categorie'=>$_GET['categories']));
                        while($reponse=$requete->fetch()){
                            ?>
                            <div class="categorie">
                            <a href="index.php?nomSujet=<?php echo $reponse['nom'];?>"><h1><?php echo $reponse['nom'];?></h1></a>
                            </div>
                        
                            <?php
                        }
                        
                        ?>
            
            
            
            
            <?php
                    
                    
                }
                    else if (isset($_GET['nomSujet'])){//dans une catégorie
                    $_GET['nomSujet'] = htmlspecialchars($_GET['nomSujet']);
                   
                        ?> <div class="categorie">
                        <h1> <?php echo $_GET['nomSujet'];?></h1>
                        </div> 
                    <?php 
            
                    $requete=$bdd->prepare('SELECT * FROM postSujet WHERE sujet = :sujet');
                    $requete->execute(array('sujet'=>$_GET['nomSujet']));  
                        
                        while($reponse=$requete->fetch()){
                    ?>
                            <div class="post">
                            <?php  
                                $requete2 =$bdd->prepare('SELECT * FROM membres WHERE id= :id');
                                $requete2->execute(array('id'=>$reponse['createur']));
                                $membre= $requete2->fetch();
                                echo $membre ['pseudo'];echo ' : <br>';
                                echo $reponse['contenu'];
                            ?>
                            </div>

                        <?php  
                        } 
                        ?>
        </div>
                        <form method="post" action="index.php?nomSujet=<?php echo $_GET['nomSujet']; ?>" >
                            <div class="reponse">
                            <textarea rows="10" name ="sujetContent" placeholder="Votre réponse..." style="width: 100%;"></textarea><br>
                            <input type="hidden" name ="nomSujet" value="<?php echo $_GET['nomSujet']; ?>">
                            <input type="hidden" name ="nomSujet" value="<?php echo $_GET['nomSujet']; ?>">
                            <input type="submit" value="Répondre" class="btn"/>
                            <?php 
                                if(isset($erreur)){
                                    echo $erreur;
                                }
                            ?>
                            </div>
                        </form>
                <?php  
                }
                else{//sur la page normale
                    
            
                    $requete = $bdd->query('SELECT * FROM categories');
                    
                    while($reponse = $requete->fetch()){
                    ?>
                        <div class="categorie">
                            <a href="index.php?categories= <?php echo $reponse['nom']; ?>"><?php echo $reponse['nom']; ?></a>
                        </div>
                        
                    <?php 
                    }
                    
                }   
                ?>
       
            
            
            
        


        
    </main>
    
</body>

</html>