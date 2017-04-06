<?php   include_once 'function.php';
class connexion{
    private $pseudo;
    private $mdp;
    private $bdd;
    
    public function __construct($pseudo,$mdp){
        $this->pseudo=$pseudo;
        $this->mdp=$mdp;
        $this->bdd = bdd();
    }
    


public function verif(){
    
    $requete = $this->bdd->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
    $requete->execute(array('pseudo'=>$this->pseudo));
    $reponse = $requete->fetch();
        if($reponse){
            if($this->mdp == $reponse['password']){

                return 'ok';
            }
            else{

                $erreur='mot de passe incorrect';
                return $erreur;
            }
         
        }
        else{
                $erreur= 'Pseudo non présent dans la base';
                return $erreur;
        }
    }
  
public function Session(){
    
        $requete = $this->bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo');
        $requete->execute(array('pseudo'=>$this->pseudo));
        $requete = $requete->fetch();
        $_SESSION ['id'] = $requete['id'];
        $_SESSION['pseudo']=$this->pseudo;
        return 1;
    }  
    
    
    
    
}
?>