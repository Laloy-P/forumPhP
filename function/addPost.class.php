<?php

include_once'function.php';

class addPost{
    
    private $nomSujet;
    private $sujetContent;
    private $bdd;
    
    public function __construct($nom,$content){
        
        $this->nomSujet = htmlspecialchars($nom);
        $this->sujetContent = htmlspecialchars($content);
        $this->bdd=bdd();
            
    }
    
    public function verif(){
        
            if(strlen($this->sujetContent) > 0){//si on a bien qqchose dans le sujet
               
                return 'ok';
            }
            else{//si il n'y a pas de contenu dans le sujet
                $erreur='veuillez entrer du contenu dans votre sujet.';
                return $erreur;
            }  
                
    }
    
    public function insert(){
        
            
        $requete = $this->bdd->prepare('INSERT INTO postSujet (createur,contenu,date,sujet) VALUES(:prop,:content,NOW(),:sujet)');
        $requete->execute(array(
            'prop'=>$_SESSION['id'],
            'content'=>$this->sujetContent,
            'sujet'=>$this->nomSujet,
            ));
       
    }
    
    
    
}
?>