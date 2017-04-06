<?php 
//session_start();
include_once 'function.php';

class inscription{
    private $pseudo;
    private $email;
    private $mdp;
    private $mdpConfirm;
    private $bdd;
    
    public function __construct($pseudo,$email,$mdp,$mdpConfirm){
        
        $pseudo=htmlspecialchars($pseudo);
        $mail=htmlspecialchars($email);
        
        $this->pseudo=$pseudo;
        $this->email=$email;
        $this->mdp=$mdp;
        $this->mdpConfirm=$mdpConfirm;
        $this->bdd= bdd();
        
    }
    

    
    
    public function verif(){
        
        
        
        if( strlen($this->pseudo) > 5 AND strlen($this->pseudo) <20 ){//pseudo correct
            $syntaxe = '/^(([a-zA-Z]|[0-9])|([-]|[_]|[.]))+[@](([a-zA-Z0-9])|([-])){2,63}[.](([a-zA-Z0-9]){2,63})+$/';
            if(preg_match($syntaxe,$this->email)){//verif de l'email
                
                if(strlen($this->mdp) > 3){//le mdp doit faire minimun 6 carractères
                    
                    if($this->mdp==$this->mdpConfirm){//les 2 mdp sont identique
                        return 'ok';
                    }
                    else{//mdp différents
                        $erreur='Les mots de passe doivent être identiques';
                        return $erreur; 
                    }
                    
                }
                else{//mdp trop court
                    $erreur='Votre mot de passe doit contenir au moins 6 carractères';
                    return $erreur; 
                }
                
            }
            else{//mai ne respecte pas le Regex
                $erreur='Veuilliez entrer une adresse mail valide';
                return $erreur; 
            }
            
        }
        else{//pseudo trop court ou trop long
            $erreur='votre pseudo doit etre compris entre 5 et 20 caractère';
            return $erreur;
        }
        
        
        
        
    
    }
    
    
    
    public function enregistrement(){
        
        $requete = $this->bdd->prepare('INSERT INTO membres (mail,password,pseudo) Values(:mail,:mdp,:pseudo)');
        $requete->execute(array(
        'mail'=>$this->email,
        'mdp'=>$this->mdp,
        'pseudo'=>$this->pseudo,
        ));
    }
    
    
    public function session(){
        $requete = $this->bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo');
        $requete->execute(array('pseudo'=>$this->pseudo));
        $requete = $requete->fetch();
        $_SESSION ['id'] = $requete['id'];
        $_SESSION['pseudo']=$this->pseudo;
        return 1;
    }
    
    
    
    
    
    
}