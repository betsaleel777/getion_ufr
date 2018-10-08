<?php
 namespace Library\Entities ;

 class Ues extends \Library\Entity{
   private $nom ;
   private $volume_horaire ;
   private $code ;

   const ERREUR_NOM = '<span style="color:red">renseignez une ue non vide contenant au plus 80 caractères</span>' ;
   const ERREUR_HORAIRE = '<span style="color:red">renseignez un volume horaire non vide en chiffre</span>' ;
   const ERREUR_CODE = '<span style="color:red">renseignez un code correcte</span>' ;
   public function nom(){
     return $this->nom ;
   }
   public function volume_horaire(){
     return $this->volume_horaire ;
   }
   public function code(){return $this->code ;}
   public function setNom($val){
     if(!empty($val) and strlen($val)<=80 ){
       $this->nom = $val ;
     }else{
       $this->setErreurs(array('nom' => self::ERREUR_NOM )) ;
     }
   }
  public function setVolume_horaire($val){
    if(!empty($val) and ctype_digit($val) and \strlen($val)<=3){
      $this->volume_horaire = $val ;
    }else {
      $this->setErreurs(array('volume_horaire' => self::ERREUR_HORAIRE )) ;
    }
  }
  public function setCode($val){
    if(!empty($val)){
      $this->code = $val ;
    }else {
      $this->setErreurs(array('code' => self::ERREUR_CODE)) ;
    }
  }
}
