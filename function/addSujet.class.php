<?php

include_once'function.php';

class addSujet{
    private $nomSujet;
    private $sujetContent;
    private $bdd;
    private $categorie;
    
    public function __construct($nom,$content,$cat){
        
        $this->nomSujet = htmlspecialchars($nom);
        $this->sujetContent = htmlspecialchars($content);
        $this->categorie = htmlspecialchars($cat);
        $this->bdd=bdd();
            
    }
    
    public function verif(){
        
        if (strlen($this->nomSujet) >5 AND strlen($this->nomSujet) < 100){//si le nom est bon
            if(strlen($this->sujetContent) > 0){//si on a bien qqchose dans le sujet
               
                return 'ok';
            }
            else{//si il n'y a pas de contenu dans le sujet
                $erreur='veuillez entrer du contenu dans votre sujet.';
                return $erreur;
            }  
                
            
  
            
        }
        else{//si le nom du sujet est incorrect
            $erreur = 'Le nom du sujet doit contenir entre 5 et 20 carractères';
            return $erreur;
        }
    }
    
    public function insert(){
        
      
        $requete = $this->bdd->prepare('INSERT INTO sujet(nom,categorie) VALUES(:nom,:categorie)');
        $requete->execute(array('nom' =>$this->nomSujet,
                                'categorie' =>$this->categorie));
            
        $requete2 = $this->bdd->prepare('INSERT INTO postSujet (createur,contenu,date,sujet) VALUES(:prop,:content,NOW(),:sujet)');
        $requete2->execute(array(
            'prop'=>$_SESSION['id'],
            'content'=>$this->sujetContent,
            'sujet'=>$this->nomSujet,
            ));
       
    }
    
    
    
}
?>