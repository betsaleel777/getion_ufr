<?php
 namespace Library\Entities ;

 class Ues extends \Library\Entity{
   private $nom ;
   private $volume_horaire ;
   private $annee_universitaire ;

   const ERREUR_NOM = '<span style="color:red">renseignez une ue non vide contenant au plus 80 caractères</span>' ;
   const ERREUR_ANNEE = '<span style="color:red">renseignez une année non vide contenant au plus 10 caractères</span>' ;
   const ERREUR_HORAIRE = '<span style="color:red">renseignez un volume horaire non vide en chiffre</span>' ;
   public function nom(){
     return $this->nom ;
   }
   public function volume_horaire(){
     return $this->volume_horaire ;
   }
   public function annee_universitaire(){
     return $this->annee_universitaire ;
   }
   public function setNom($val){
     if(!empty($val) and strlen($val)<=80 ){
       $this->nom = $val ;
     }else{
       $this->setErreurs(array('nom' => self::ERREUR_NOM )) ;
     }
   }
  public function setAnnee_universitaire($val){
    if(!empty($val) and strlen($val)<=10){
      $this->annee_universitaire = $val ;
    }else {
      $this->setErreurs(array('annee_universitaire' => self::ERREUR_ANNEE )) ;
    }
  }
  public function setVolume_horaire($val){
    if(!empty($val) and ctype_digit($val) and \strlen($val)<=3){
      $this->volume_horaire = $val ;
    }else {
      $this->setErreurs(array('volume_horaire' => self::ERREUR_HORAIRE )) ;
    }
  }
}
