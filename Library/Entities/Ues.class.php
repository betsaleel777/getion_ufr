<?php
 namespace Library\Entities ;

 class Ues extends \Library\Entity{
   private $nom ;
   private $code ;

   const MESSAGE_ERREUR_NOM = '<span style="color:red">renseignez une ue non vide contenant au plus 80 caractères</span>' ;
   const MESSAGE_ERREUR_CODE = '<span style="color:red">renseignez un code correcte</span>' ;
   const ERREUR_NOM = 0 ;
   const ERREUR_CODE = 1 ;

   public function nom(){
     return $this->nom ;
   }
   public function code(){return $this->code ;}

   public function setNom($val){
     if(!empty($val) and strlen($val)<=80 ){
       $this->nom = $val ;
     }else{
       $this->setCustomErrors(self::ERREUR_NOM ) ;
     }
   }
  public function setCode($val){
    if(!empty($val)){
      $this->code = $val ;
    }else {
      $this->setCustomErrors(self::ERREUR_CODE) ;
    }
  }

}
